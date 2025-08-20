<?php
if (!defined('ABSPATH')) {
	exit;
}

class Vayu_blocks_toc {

	private $attr;

	public function __construct($attr) {
		$this->attr = $attr;
	}

	public function render() {
		global $vayu_toc_position;
		$position = $this->attr['inserterPosition'] ?? 'default';
		$vayu_toc_position = $position;
		$tocHTML  = $this->render_toc();
		add_filter('render_block', [ $this, 'vayu_blocks_add_heading_ids_globally' ], 10, 2);

		switch ( $position ) {
			case 'after-heading':
				return $this->inject_toc_near_heading( $tocHTML, 'after' );

			case 'before-heading':
				return $this->inject_toc_near_heading( $tocHTML , 'before');

			default:
				return $tocHTML;
		}
	}

	public function vayu_blocks_add_heading_ids_globally($block_content, $block) {
		if (empty(trim($block_content))) {
			return $block_content;
		}

		// 🧠 Quick check: Does block HTML have any heading?
		if (!preg_match('/<h[1-6][^>]*>.*?<\/h[1-6]>/i', $block_content)) {
			return $block_content; // no headings, skip
		}

		// ✅ Wrap in valid HTML to avoid DOM issues
		$wrapped = '<!DOCTYPE html><html><body>' . $block_content . '</body></html>';

		$doc = new DOMDocument();
		libxml_use_internal_errors(true);
		$doc->loadHTML(mb_convert_encoding($wrapped, 'HTML-ENTITIES', 'UTF-8'));
		libxml_clear_errors();

		$xpath = new DOMXPath($doc);
		$headings = $xpath->query('//h1 | //h2 | //h3 | //h4 | //h5 | //h6');

		foreach ($headings as $heading) {

			$text = trim($heading->textContent);
			if ($text) {
				$id = 'vb-' . sanitize_title($text);
				$heading->setAttribute('id', $id);
			}
		}

		$body = $doc->getElementsByTagName('body')->item(0);
		$new_content = '';
		if ($body) {
			foreach ($body->childNodes as $child) {
				$new_content .= $doc->saveHTML($child);
			}
			return $new_content;
		}

		return $block_content;
	}

	private function inject_toc_near_heading( $tocHTML, $position = 'after' ) {
		$content = get_post_field( 'post_content', get_the_ID() );
		$blocks  = parse_blocks( $content );

		$newBlocks = [];
		$injected  = false;

		foreach ( $blocks as $block ) {
			// Inject BEFORE heading-type block
			if (
				! $injected &&
				$position === 'before' &&
				isset( $block['blockName'] ) &&
				strpos( $block['blockName'], 'heading' ) !== false
			) {
				$newBlocks[] = [
					'blockName'     => 'vayu-blocks/table-of-contents',
					'attrs'         => [],
					'innerHTML'     => $tocHTML,
					'innerContent'  => [ $tocHTML ],
				];
				$injected = true;
			}

			// Always push the current block
			$newBlocks[] = $block;

			// Inject AFTER heading-type block
			if (
				! $injected &&
				$position === 'after' &&
				isset( $block['blockName'] ) &&
				strpos( $block['blockName'], 'heading' ) !== false
			) {
				$newBlocks[] = [
					'blockName'     => 'vayu-blocks/table-of-contents',
					'attrs'         => [],
					'innerHTML'     => $tocHTML,
					'innerContent'  => [ $tocHTML ],
				];
				$injected = true;
			}
		}

		// If nothing injected (no heading-like block), add at end
		if ( ! $injected ) {
			$newBlocks[] = [
				'blockName'     => 'vayu-blocks/table-of-contents',
				'attrs'         => [],
				'innerHTML'     => $tocHTML,
				'innerContent'  => [ $tocHTML ],
			];
		}

		// Re-render all
		$final = '';
		foreach ( $newBlocks as $block ) {
			$final .= render_block( $block );
		}

		return $final;
	}

	private function render_toc() {
		$attributes = $this->attr;
		$OBJ_STYLE = new VAYUBLOCKS_RESPONSIVE_STYLE($attributes);
		$uniqueId = $attributes['uniqueId'] ?? 'vb-toc-' . wp_rand();
		$animated = $attributes['className'] ?? '';
		$classes = [];

		$classes_wrapper = ['vb-toc-wrapper', 'columns-' . ($attributes['columns'] ?? 1)];
		$classes_wrapper[] = 'marker-' . ($attributes['markerStyle'] ?? '');
		$classes_wrapper[] = 'separator-' . ($attributes['separator'] ?? '');

		$toc_html  = '<div class="' . esc_attr(implode(' ', $classes_wrapper)) . '">';
			$toc_html .= $this->render_title($attributes);
			$toc_html .= $this->render_list($attributes);
		$toc_html .= '</div>';

		$containerClass = 'vb-toc-container' . esc_attr($uniqueId);
		$classes = [$containerClass];

		if (!empty($attributes['animationData']['effect']['effectHover'])) {
			$classes[] = 'vayu-blocks-image-hover';
		}
		if (!empty($animated) && $animated !== 'none') {
			$classes[] = $animated;
		}
		if (!empty($attributes['advAnimation']['className'])) {
			$classes[] = $attributes['advAnimation']['className'];
		}

		if (!empty($attributes['enableShrink']) && $attributes['enableShrink']) {
			$classes[] = 'shrink-when-collapsed';
		}

		$finalClass = implode(' ', $classes);

		$toc_html .= $OBJ_STYLE->renderVideo('advBackground');
		$dataAttributes = $OBJ_STYLE->follower();

		return '<div id="' . esc_attr($uniqueId) . '" ' . $dataAttributes . ' ' . get_block_wrapper_attributes([
			'class' => $finalClass
		]) . '>' . $toc_html . '</div>';
	}

	private function render_title($attributes) {
		$tocTitle         = $attributes['tocTitle'] ?? __('Table Of Contents', 'vayu-blocks');
		$enableCollapse   = !empty($attributes['enableCollapse']);
		$overallalignment = $attributes['overallalignment'] ?? 'left';

		$html = '<div class="vb-toc-title">';

		if ($overallalignment === 'left' && $enableCollapse) {
			$html .= $this->render_icon_button($attributes);
		}

		$html .= '<div class="vb-toc-title-content">' . esc_html($tocTitle) . '</div>';

		
		if ($overallalignment === 'right' && $enableCollapse) {
			$html .= $this->render_icon_button($attributes);
		}

		$html .= '</div>';
		return $html;
	}

	private function render_icon_button($attributes) {
		$collapseBehavior = $attributes['collapseBehavior'] ?? 'open';
		$openState        = $collapseBehavior === 'open';
		$activeicon       = $attributes['activeiconName'] ?? '';
		$inactiveicon     = $attributes['inactiveiconName'] ?? '';
		$activeText        = $attributes['activetext'] ?? '';
		$inactiveText      = $attributes['inactivetext'] ?? '';

		$activeIconHTML   = vayu_blocks_get_icon_svg($activeicon);
		$inactiveIconHTML = vayu_blocks_get_icon_svg($inactiveicon);

		$html  = '<button type="button" class="vb-toc-toggle-button" aria-expanded="' . ($openState ? 'true' : 'false') . '"';
			$html .= ' data-active-icon="' . esc_attr($activeIconHTML) . '"';
			$html .= ' data-inactive-icon="' . esc_attr($inactiveIconHTML) . '"';
			$html .= ' data-activetext="' . esc_attr($activeText) . '"';
			$html .= ' data-inactivetext="' . esc_attr($inactiveText) . '"';
		$html .= '>';
			$html .= $openState ? $activeIconHTML : $inactiveIconHTML;
		$html .= '</button>';

		return $html;
	}

	private function render_list($attributes) {
		$headingsEnabled = $attributes['heading'] ?? [];
		$allowedLevels = [];

		// Extract enabled heading levels (h1–h6)
		foreach ($headingsEnabled as $key => $enabled) {
			if ($enabled && preg_match('/^h([1-6])$/', $key, $match)) {
				$allowedLevels[] = (int) $match[1];
			}
		}

		$post_blocks  = parse_blocks(get_the_content());
		$headingsData = $this->vayu_blocks_get_all_headings($post_blocks, $allowedLevels);

		$enableCollapse   = !empty($attributes['enableCollapse']);
		$collapseLimit    = intval($attributes['collapseLimit'] ?? 0);
		$collapseBehavior = $attributes['collapseBehavior'] ?? 'open';
		$openState        = $collapseBehavior === 'open';

		if (empty($headingsData)) {
			return '<p class="vb-toc-list empty-toc vb-toc-placeholder">' . esc_html__('Add a header to begin generating the table of contents.', 'vayu-blocks') . '</p>';
		}

		$html = '';

		if (!empty($attributes['separator']) && $attributes['separator'] !== 'none') {
			$html .= '<hr class="vb-toc-separator separator-' . esc_attr($attributes['separator']) . '" />';
		}

		$markerStyle = $attributes['markerStyle'] ?? 'disc';

		$hierarchyType = $attributes['hierarchyType'] ?? 'nested';

		switch ($hierarchyType) {
			case 'flat':
				$html .= $this->render_flat_list($headingsData, $markerStyle, $collapseLimit, $openState);
				break;

			case 'limited':
				$html .= $this->render_limited_nested_list($headingsData, 0, $markerStyle, $collapseLimit, $openState, [], 2);
				break;

			case 'deep-numbered':
				$html .= $this->render_deep_numbered_list($headingsData, $markerStyle,  $collapseLimit, $openState);
				break;

			default:
				$html .= $this->render_nested_list($headingsData, 0, $markerStyle, $collapseLimit, $openState, []);
				break;
		}

		return $html;
	}

	private function render_nested_list($items, $currentLevel = 0, $markerStyle = 'disc', $collapseLimit = 0, $openState = true, $parentIndexPath = []) {
		if (empty($items)) return '';

		$html = '';
		$tag = $markerStyle === 'decimal' ? 'ol' : 'ul';

		// Only top-level list gets class and data attribute
		if ($currentLevel === 0) {
			$html .= '<' . $tag . ' class="vb-toc-list" data-collapse-limit="' . esc_attr($collapseLimit) . '">';
		} else {
			$html .= '<' . $tag . '>';
		}

		$i = 0;
		$siblingIndex = 0;

		while ($i < count($items)) {
			$current = $items[$i];
			$children = [];

			// Count how many siblings at this level (per branch)
			$siblingIndex++;
			$indexPath = array_merge($parentIndexPath, [$siblingIndex]);

			$i++;
			while ($i < count($items) && $items[$i]['level'] > $current['level']) {
				$children[] = $items[$i];
				$i++;
			}

			$isCollapsed = $collapseLimit && !$openState && (count($parentIndexPath) === 0 && $siblingIndex > $collapseLimit);
			$collapsedClass = $isCollapsed ? ' is-collapsed' : '';
			$ariaHidden = $isCollapsed ? ' aria-hidden="true"' : '';

			$html .= '<li class="vb-toc-item level-' . intval($current['level']) . $collapsedClass . '"' . $ariaHidden . '>';
			$html .= '<a href="#' . esc_attr($current['id']) . '" class="vb-toc-link" data-scroll>';

			if ($markerStyle === 'decimal') {
				$html .= esc_html(implode('.', $indexPath)) . '. ';
			}

			$html .= esc_html($current['text']) . '</a>';

			if (!empty($children)) {
				$html .= $this->render_nested_list($children, $current['level'] + 1, $markerStyle, $collapseLimit, $openState, $indexPath);
			}

			$html .= '</li>';
		}

		$html .= '</' . $tag . '>';
		return $html;
	}

	private function render_flat_list($items, $markerStyle = 'disc', $collapseLimit = 0, $openState = true) {
		if (empty($items)) return '';

		$tag = $markerStyle === 'decimal' ? 'ol' : 'ul';
		$html = '<' . $tag . ' class="vb-toc-list" data-collapse-limit="' . esc_attr($collapseLimit) . '">';

		foreach ($items as $index => $item) {
			$isCollapsed = $collapseLimit && !$openState && $index >= $collapseLimit;
			$collapsedClass = $isCollapsed ? ' is-collapsed' : '';
			$ariaHidden = $isCollapsed ? ' aria-hidden="true"' : '';

			$html .= '<li class="vb-toc-item level-' . intval($item['level']) . $collapsedClass . '"' . $ariaHidden . '>';
			$html .= '<a href="#' . esc_attr($item['id']) . '">';

			if ($markerStyle === 'decimal') {
				$html .= esc_html($index + 1) . '. ';
			}

			$html .= esc_html($item['text']) . '</a></li>';
		}

		$html .= '</' . $tag . '>';
		return $html;
	}

	private function render_limited_nested_list($items, $currentLevel = 0, $markerStyle = 'disc', $collapseLimit = 0, $openState = true, $parentIndexPath = [], $maxDepth = 2) {
		if (empty($items) || count($parentIndexPath) >= $maxDepth) return '';

		$tag = $markerStyle === 'decimal' ? 'ol' : 'ul';
		$html = ($currentLevel === 0) ? '<' . $tag . ' class="vb-toc-list" data-collapse-limit="' . esc_attr($collapseLimit) . '">' : '<' . $tag . '>';

		$i = 0;
		$siblingIndex = 0;

		while ($i < count($items)) {
			$current = $items[$i];
			$children = [];

			$siblingIndex++;
			$indexPath = array_merge($parentIndexPath, [$siblingIndex]);

			$i++;
			while (
				$i < count($items) &&
				$items[$i]['level'] > $current['level'] &&
				count($indexPath) < $maxDepth
			) {
				$children[] = $items[$i];
				$i++;
			}

			$isCollapsed = $collapseLimit && !$openState && (count($parentIndexPath) === 0 && $siblingIndex > $collapseLimit);
			$collapsedClass = $isCollapsed ? ' is-collapsed' : '';
			$ariaHidden = $isCollapsed ? ' aria-hidden="true"' : '';

			$html .= '<li class="vb-toc-item level-' . intval($current['level']) . $collapsedClass . '"' . $ariaHidden . '>';
			$html .= '<a href="#' . esc_attr($current['id']) . '">';

			if ($markerStyle === 'decimal') {
				$html .= esc_html(implode('.', $indexPath)) . '. ';
			}

			$html .= esc_html($current['text']) . '</a>';

			if (!empty($children)) {
				$html .= $this->render_limited_nested_list($children, $current['level'] + 1, $markerStyle, $collapseLimit, $openState, $indexPath, $maxDepth);
			}

			$html .= '</li>';
		}

		$html .= '</' . $tag . '>';
		return $html;
	}

	private function render_deep_numbered_list($items, $markerStyle = 'decimal', $collapseLimit = 0, $openState = true, $parentIndexPath = []) {
		if (empty($items)) return '';

		$tag = $markerStyle === 'decimal' ? 'ol' : 'ul';
		$html = empty($parentIndexPath) ? '<' . $tag . ' class="vb-toc-list">' : '<' . $tag . '>';

		$i = 0;
		$siblingCount = [];

		while ($i < count($items)) {
			$current = $items[$i];
			$currentLevel = intval($current['level']);
			$children = [];

			$indexPath = $parentIndexPath;

			// Fill skipped heading levels with 0
			for ($lvl = count($indexPath) + 1; $lvl < $currentLevel; $lvl++) {
				$indexPath[] = 0;
			}

			// Maintain count per level
			if (!isset($siblingCount[$currentLevel])) {
				$siblingCount[$currentLevel] = 1;
			} else {
				$siblingCount[$currentLevel]++;
			}
			$indexPath[] = $siblingCount[$currentLevel];

			// Gather children
			$j = $i + 1;
			while ($j < count($items) && intval($items[$j]['level']) > $currentLevel) {
				$children[] = $items[$j];
				$j++;
			}

			// Collapse logic for top-level
			$siblingIndex = $indexPath[0];
			$isCollapsed = $collapseLimit && !$openState && $currentLevel == 1 && $siblingIndex > $collapseLimit;
			$collapsedClass = $isCollapsed ? ' is-collapsed' : '';
			$ariaHidden = $isCollapsed ? ' aria-hidden="true"' : '';

			$html .= '<li class="vb-toc-item level-' . $currentLevel . $collapsedClass . '"' . $ariaHidden . '>';
			$html .= '<a href="#' . esc_attr($current['id']) . '">';

			if ($markerStyle === 'decimal' && count($indexPath) > 1) {
				$html .= esc_html(implode('.', array_slice($indexPath, 1))) . '. ';
			}

			$html .= esc_html($current['text']) . '</a>';

			if (!empty($children)) {
				$html .= $this->render_deep_numbered_list($children, $markerStyle, $collapseLimit, $openState, $indexPath, $currentLevel);
			}

			$html .= '</li>';
			$i = $j;
		}

		$html .= '</' . $tag . '>';
		return $html;
	}

	private function vayu_blocks_get_all_headings($blocks, $allowedLevels = [], &$headings = []) {
		foreach ($blocks as $block) {
			if (empty($block['blockName'])) continue;

			$name  = strtolower($block['blockName']);
			$attrs = $block['attrs'] ?? [];
			$html  = $block['innerHTML'] ?? '';

			$text  = '';
			$level = '';
			$id    = '';

			// ✅ Check only heading blocks
			if (strpos($name, 'heading') !== false) {
				$doc = new DOMDocument();
				libxml_use_internal_errors(true);
				$doc->loadHTML('<?xml encoding="utf-8" ?>' . $html);
				libxml_clear_errors();

				$xpath = new DOMXPath($doc);
				$hNode = $xpath->query('//h1 | //h2 | //h3 | //h4 | //h5 | //h6')->item(0);

				// ✅ Only proceed if heading tag exists
				if ($hNode) {
					$level = (int) str_replace('H', '', $hNode->nodeName);
					$text  = trim($hNode->textContent ?? '');

					// ✅ Generate ID
					$id = $attrs['anchor'] ?? $attrs['block_id'] ?? $attrs['uniqueID'] ?? $this->sanitize_heading_id($text);

					// ✅ Inject ID into the node
					$hNode->setAttribute('id', $id);

					// ✅ Override level if provided in attributes
					if (isset($attrs['level']) && is_numeric($attrs['level'])) {
						$level = (int) $attrs['level'];
					} elseif (!empty($attrs['headingTag'])) {
						$level = (int) str_replace('h', '', strtolower($attrs['headingTag']));
					} elseif (!empty($attrs['tagName'])) {
						$level = (int) str_replace('h', '', strtolower($attrs['tagName']));
					} elseif (!empty($attrs['tag'])) {
						$level = (int) str_replace('h', '', strtolower($attrs['tag']));
					}

					// ✅ Fallback level if parsing failed
					if (!$level) {
						$level = 2;
					}

					// ✅ Fallback ID
					if (empty($id)) {
						$id = $this->sanitize_heading_id($text);
					}

					// ✅ Store only valid headings
					if ($text && in_array((int) $level, $allowedLevels, true)) {
						$headings[] = [
							'text'  => $text,
							'level' => (int) $level,
							'id'    => $id,
						];
					}
				}
			}

			// ✅ Recurse through inner blocks
			if (!empty($block['innerBlocks'])) {
				$this->vayu_blocks_get_all_headings($block['innerBlocks'], $allowedLevels, $headings);
			}
		}

		return $headings;
	}

	private function sanitize_heading_id($text) {
		$text = strtolower($text);
		$text = preg_replace('/[^\p{L}\p{N}\s]+/u', '', $text); // remove special chars
		$text = preg_replace('/\s+/', '-', trim($text)); // spaces to hyphens
		return 'vb-' . sanitize_title($text);
	}
}

function vayu_block_toc_render($attr) {
	if ((new VAYUBLOCKS_DISPLAY_CONDITION($attr))->display()) {
		return;
	}
	$default_attributes = include('defaultattributes.php');
	$attr = array_merge($default_attributes, $attr);
	$toc = new Vayu_blocks_toc($attr);
	return $toc->render();
}
