(()=>{var e,t={4943:(e,t,n)=>{"use strict";const o=window.wp.blocks,r=window.wp.i18n;function a(e){var t,n,o="";if("string"==typeof e||"number"==typeof e)o+=e;else if("object"==typeof e)if(Array.isArray(e)){var r=e.length;for(t=0;t<r;t++)e[t]&&(n=a(e[t]))&&(o&&(o+=" "),o+=n)}else for(n in e)e[n]&&(o&&(o+=" "),o+=n);return o}const i=function(){for(var e,t,n=0,o="",r=arguments.length;n<r;n++)(e=arguments[n])&&(t=a(e))&&(o&&(o+=" "),o+=t);return o},l=window.wp.element,s=window.wp.data,c=window.wp.blockEditor,u=window.wp.components;n(6942);const p=window.ReactJSXRuntime,d=(window.wp.compose,window.wp.primitives),f=(d.SVG,d.Path,d.SVG,d.Path,d.SVG,d.Path,Text,window.React);window.lodash;const m=new class{constructor(){this.fonts=[],this.status="none",this.controller=new AbortController,this.request=null,this.node=document.createElement("style"),this.node.type="text/css",this.node.setAttribute("data-generator","vayu-blocks-fonts-loader"),this.isAttaching=!1,this.usedFonts=[]}async afterLoading(){return await this.requestFonts(),this}getFont(e){return this.fonts.find((t=>t.family===e))}getVariants(e){const t=e=>{if("string"!=typeof e)throw new Error("Input must be a string");return e.toLowerCase()},n=e=>{if("string"!=typeof e)throw new Error("Input must be a string");return e.replace(/_/g," ").replace(/(?:^|\s)\S/g,(e=>e.toUpperCase()))},o=this.getFont(e);return o?o.variants.filter((e=>!1===e.includes("italic"))).map((e=>({label:n(t(e)),value:e}))):[]}async loadFontToBrowser(e,t="regular"){if(!e)return Error("Empty font name.");"none"!==this.status&&"loading"!==this.status||await this.afterLoading();const n=this.getFont(e);return n?(this.usedFonts.find((n=>n.font.family===e&&n.variant===t))||(this.usedFonts.push({font:n,variant:t}),this.updateCSSNode()),n):Error("Font does not exists.")}async requestFonts(e=!1){return"done"===this.status?this.fonts:("none"===this.status&&(this.status="loading",this.request=new Promise((async(t,n)=>{"done"!==this.status||e||t(this.fonts),e&&this.controller.abort(),fetch("https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyClGdkPJ1BvgLOol5JAkQY4Mv2lkLYu00k",{signal:this.controller.signal}).then((e=>e.json())).then((e=>{this.fonts=e.items,this.status="done",t(this.fonts)})).catch((e=>{this.status="error",n(e)}))}))),this.request)}updateCSSNode(){this.node.innerHTML=this.renderCSSFont()}attach(){this.isAttaching||(this.isAttaching=!0,setTimeout((()=>{var e;const t=null!==(e=document.querySelector('iframe[name^="editor-canvas"]')?.contentWindow?.document)&&void 0!==e?e:document;t?.querySelector('[data-generator*="vayu-blocks-fonts-loader"')||t?.head?.appendChild(this.node),this.isAttaching=!1}),500))}renderCSSFont(){return Array.from(this.usedFonts).map((({font:e,variant:t})=>{var n;const o=(null!==(n=e.files?.[t])&&void 0!==n?n:e.files?.regular)?.replace("http://","https://");return`\n\t\t\t\t@font-face {\n\t\t\t\t\tfont-family: "${e.family}";\n\t\t\t\t\tsrc: url('${o}'); /* IE9 Compat Modes */\n\t\t\t\t\tsrc: url('${o}')  format('truetype'), /* Safari, Android, iOS */\n\t\t\t\t}\n\t\t\t`})).join("\n")}};Object.seal(m),(0,r._x)("Clock","label","vayu-blocks"),(0,r._x)("Clock Outline","label","vayu-blocks"),(0,r._x)("Asterisk","label","vayu-blocks"),(0,r._x)("At","label","vayu-blocks"),(0,r._x)("Award","label","vayu-blocks"),(0,r._x)("Ban","label","vayu-blocks"),(0,r._x)("Bars","label","vayu-blocks"),(0,r._x)("Beer","label","vayu-blocks"),(0,r._x)("Bolt","label","vayu-blocks"),(0,r._x)("Book","label","vayu-blocks"),(0,r._x)("Box - Open","label","vayu-blocks"),(0,r._x)("Bullhorn","label","vayu-blocks"),(0,r._x)("Bullseye","label","vayu-blocks"),(0,r._x)("Burn","label","vayu-blocks"),(0,r._x)("Calender","label","vayu-blocks"),(0,r._x)("Check","label","vayu-blocks"),(0,r._x)("Check - Circle","label","vayu-blocks"),(0,r._x)("Check - Circle Outline","label","vayu-blocks"),(0,r._x)("Check - Square","label","vayu-blocks"),(0,r._x)("Check - Square Outline","label","vayu-blocks"),(0,r._x)("Chevron - Down","label","vayu-blocks"),(0,r._x)("Chevron - Left","label","vayu-blocks"),(0,r._x)("Chevron - Right","label","vayu-blocks"),(0,r._x)("Chevron - Up","label","vayu-blocks"),(0,r._x)("Circle","label","vayu-blocks"),(0,r._x)("Circle - Outline","label","vayu-blocks"),(0,r._x)("Coffee","label","vayu-blocks"),(0,r._x)("Dot - Circle","label","vayu-blocks"),(0,r._x)("Dot - Circle Outline","label","vayu-blocks"),(0,r._x)("Ellipses - Horizontal","label","vayu-blocks"),(0,r._x)("Ellipses - Vertical","label","vayu-blocks"),(0,r._x)("Envelope","label","vayu-blocks"),(0,r._x)("Fire","label","vayu-blocks"),(0,r._x)("Heart","label","vayu-blocks"),(0,r._x)("Map Marker","label","vayu-blocks"),(0,r._x)("Paper Plane","label","vayu-blocks"),(0,r._x)("Phone","label","vayu-blocks"),(0,r._x)("Plus","label","vayu-blocks"),(0,r._x)("Plus - Circle","label","vayu-blocks"),(0,r._x)("Plus - Square","label","vayu-blocks"),(0,r._x)("Plus - Square Outline","label","vayu-blocks"),(0,r._x)("Shield","label","vayu-blocks"),(0,r._x)("Star","label","vayu-blocks"),(0,r._x)("Tags","label","vayu-blocks"),(0,r._x)("User - Circle","label","vayu-blocks"),(0,r._x)("Facebook","label","vayu-blocks"),(0,r._x)("Facebook - Circle","label","vayu-blocks"),(0,r._x)("Facebook - Square","label","vayu-blocks"),(0,r._x)("Instagram","label","vayu-blocks"),(0,r._x)("LinkedIn","label","vayu-blocks"),(0,r._x)("LinkedIn - Square","label","vayu-blocks"),(0,r._x)("Pinterest","label","vayu-blocks"),(0,r._x)("Pinterest - Circle","label","vayu-blocks"),(0,r._x)("Pinterest - Square","label","vayu-blocks"),(0,r._x)("Reddit","label","vayu-blocks"),(0,r._x)("Reddit - Circle","label","vayu-blocks"),(0,r._x)("Reddit - Square","label","vayu-blocks"),(0,r._x)("Snapchat","label","vayu-blocks"),(0,r._x)("Soundcloud","label","vayu-blocks"),(0,r._x)("Twitch","label","vayu-blocks"),(0,r._x)("Twitter","label","vayu-blocks"),(0,r._x)("Twitter - Square","label","vayu-blocks"),(0,r._x)("Vimeo","label","vayu-blocks"),(0,r._x)("Vimeo - Square","label","vayu-blocks"),(0,r._x)("WhatsApp","label","vayu-blocks"),(0,r._x)("WhatsApp - Square","label","vayu-blocks"),(0,r._x)("YouTube","label","vayu-blocks");const{entries:b,setPrototypeOf:h,isFrozen:y,getPrototypeOf:g,getOwnPropertyDescriptor:v}=Object;let{freeze:_,seal:T,create:k}=Object,{apply:x,construct:w}="undefined"!=typeof Reflect&&Reflect;_||(_=function(e){return e}),T||(T=function(e){return e}),x||(x=function(e,t,n){return e.apply(t,n)}),w||(w=function(e,t){return new e(...t)});const S=z(Array.prototype.forEach),E=z(Array.prototype.pop),A=z(Array.prototype.push),O=z(String.prototype.toLowerCase),N=z(String.prototype.toString),C=z(String.prototype.match),L=z(String.prototype.replace),R=z(String.prototype.indexOf),M=z(String.prototype.trim),D=z(Object.prototype.hasOwnProperty),I=z(RegExp.prototype.test),P=(U=TypeError,function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];return w(U,t)});var U;function z(e){return function(t){for(var n=arguments.length,o=new Array(n>1?n-1:0),r=1;r<n;r++)o[r-1]=arguments[r];return x(e,t,o)}}function F(e,t){let n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:O;h&&h(e,null);let o=t.length;for(;o--;){let r=t[o];if("string"==typeof r){const e=n(r);e!==r&&(y(t)||(t[o]=e),r=e)}e[r]=!0}return e}function j(e){for(let t=0;t<e.length;t++)D(e,t)||(e[t]=null);return e}function B(e){const t=k(null);for(const[n,o]of b(e))D(e,n)&&(Array.isArray(o)?t[n]=j(o):o&&"object"==typeof o&&o.constructor===Object?t[n]=B(o):t[n]=o);return t}function H(e,t){for(;null!==e;){const n=v(e,t);if(n){if(n.get)return z(n.get);if("function"==typeof n.value)return z(n.value)}e=g(e)}return function(){return null}}const W=_(["a","abbr","acronym","address","area","article","aside","audio","b","bdi","bdo","big","blink","blockquote","body","br","button","canvas","caption","center","cite","code","col","colgroup","content","data","datalist","dd","decorator","del","details","dfn","dialog","dir","div","dl","dt","element","em","fieldset","figcaption","figure","font","footer","form","h1","h2","h3","h4","h5","h6","head","header","hgroup","hr","html","i","img","input","ins","kbd","label","legend","li","main","map","mark","marquee","menu","menuitem","meter","nav","nobr","ol","optgroup","option","output","p","picture","pre","progress","q","rp","rt","ruby","s","samp","section","select","shadow","small","source","spacer","span","strike","strong","style","sub","summary","sup","table","tbody","td","template","textarea","tfoot","th","thead","time","tr","track","tt","u","ul","var","video","wbr"]),G=_(["svg","a","altglyph","altglyphdef","altglyphitem","animatecolor","animatemotion","animatetransform","circle","clippath","defs","desc","ellipse","filter","font","g","glyph","glyphref","hkern","image","line","lineargradient","marker","mask","metadata","mpath","path","pattern","polygon","polyline","radialgradient","rect","stop","style","switch","symbol","text","textpath","title","tref","tspan","view","vkern"]),q=_(["feBlend","feColorMatrix","feComponentTransfer","feComposite","feConvolveMatrix","feDiffuseLighting","feDisplacementMap","feDistantLight","feDropShadow","feFlood","feFuncA","feFuncB","feFuncG","feFuncR","feGaussianBlur","feImage","feMerge","feMergeNode","feMorphology","feOffset","fePointLight","feSpecularLighting","feSpotLight","feTile","feTurbulence"]),Y=_(["animate","color-profile","cursor","discard","font-face","font-face-format","font-face-name","font-face-src","font-face-uri","foreignobject","hatch","hatchpath","mesh","meshgradient","meshpatch","meshrow","missing-glyph","script","set","solidcolor","unknown","use"]),V=_(["math","menclose","merror","mfenced","mfrac","mglyph","mi","mlabeledtr","mmultiscripts","mn","mo","mover","mpadded","mphantom","mroot","mrow","ms","mspace","msqrt","mstyle","msub","msup","msubsup","mtable","mtd","mtext","mtr","munder","munderover","mprescripts"]),X=_(["maction","maligngroup","malignmark","mlongdiv","mscarries","mscarry","msgroup","mstack","msline","msrow","semantics","annotation","annotation-xml","mprescripts","none"]),$=_(["#text"]),K=_(["accept","action","align","alt","autocapitalize","autocomplete","autopictureinpicture","autoplay","background","bgcolor","border","capture","cellpadding","cellspacing","checked","cite","class","clear","color","cols","colspan","controls","controlslist","coords","crossorigin","datetime","decoding","default","dir","disabled","disablepictureinpicture","disableremoteplayback","download","draggable","enctype","enterkeyhint","face","for","headers","height","hidden","high","href","hreflang","id","inputmode","integrity","ismap","kind","label","lang","list","loading","loop","low","max","maxlength","media","method","min","minlength","multiple","muted","name","nonce","noshade","novalidate","nowrap","open","optimum","pattern","placeholder","playsinline","popover","popovertarget","popovertargetaction","poster","preload","pubdate","radiogroup","readonly","rel","required","rev","reversed","role","rows","rowspan","spellcheck","scope","selected","shape","size","sizes","span","srclang","start","src","srcset","step","style","summary","tabindex","title","translate","type","usemap","valign","value","width","wrap","xmlns","slot"]),Z=_(["accent-height","accumulate","additive","alignment-baseline","amplitude","ascent","attributename","attributetype","azimuth","basefrequency","baseline-shift","begin","bias","by","class","clip","clippathunits","clip-path","clip-rule","color","color-interpolation","color-interpolation-filters","color-profile","color-rendering","cx","cy","d","dx","dy","diffuseconstant","direction","display","divisor","dur","edgemode","elevation","end","exponent","fill","fill-opacity","fill-rule","filter","filterunits","flood-color","flood-opacity","font-family","font-size","font-size-adjust","font-stretch","font-style","font-variant","font-weight","fx","fy","g1","g2","glyph-name","glyphref","gradientunits","gradienttransform","height","href","id","image-rendering","in","in2","intercept","k","k1","k2","k3","k4","kerning","keypoints","keysplines","keytimes","lang","lengthadjust","letter-spacing","kernelmatrix","kernelunitlength","lighting-color","local","marker-end","marker-mid","marker-start","markerheight","markerunits","markerwidth","maskcontentunits","maskunits","max","mask","media","method","mode","min","name","numoctaves","offset","operator","opacity","order","orient","orientation","origin","overflow","paint-order","path","pathlength","patterncontentunits","patterntransform","patternunits","points","preservealpha","preserveaspectratio","primitiveunits","r","rx","ry","radius","refx","refy","repeatcount","repeatdur","restart","result","rotate","scale","seed","shape-rendering","slope","specularconstant","specularexponent","spreadmethod","startoffset","stddeviation","stitchtiles","stop-color","stop-opacity","stroke-dasharray","stroke-dashoffset","stroke-linecap","stroke-linejoin","stroke-miterlimit","stroke-opacity","stroke","stroke-width","style","surfacescale","systemlanguage","tabindex","tablevalues","targetx","targety","transform","transform-origin","text-anchor","text-decoration","text-rendering","textlength","type","u1","u2","unicode","values","viewbox","visibility","version","vert-adv-y","vert-origin-x","vert-origin-y","width","word-spacing","wrap","writing-mode","xchannelselector","ychannelselector","x","x1","x2","xmlns","y","y1","y2","z","zoomandpan"]),J=_(["accent","accentunder","align","bevelled","close","columnsalign","columnlines","columnspan","denomalign","depth","dir","display","displaystyle","encoding","fence","frame","height","href","id","largeop","length","linethickness","lspace","lquote","mathbackground","mathcolor","mathsize","mathvariant","maxsize","minsize","movablelimits","notation","numalign","open","rowalign","rowlines","rowspacing","rowspan","rspace","rquote","scriptlevel","scriptminsize","scriptsizemultiplier","selection","separator","separators","stretchy","subscriptshift","supscriptshift","symmetric","voffset","width","xmlns"]),Q=_(["xlink:href","xml:id","xlink:title","xml:space","xmlns:xlink"]),ee=T(/\{\{[\w\W]*|[\w\W]*\}\}/gm),te=T(/<%[\w\W]*|[\w\W]*%>/gm),ne=T(/\$\{[\w\W]*}/gm),oe=T(/^data-[\-\w.\u00B7-\uFFFF]+$/),re=T(/^aria-[\-\w]+$/),ae=T(/^(?:(?:(?:f|ht)tps?|mailto|tel|callto|sms|cid|xmpp):|[^a-z]|[a-z+.\-]+(?:[^a-z+.\-:]|$))/i),ie=T(/^(?:\w+script|data):/i),le=T(/[\u0000-\u0020\u00A0\u1680\u180E\u2000-\u2029\u205F\u3000]/g),se=T(/^html$/i),ce=T(/^[a-z][.\w]*(-[.\w]+)+$/i);var ue=Object.freeze({__proto__:null,ARIA_ATTR:re,ATTR_WHITESPACE:le,CUSTOM_ELEMENT:ce,DATA_ATTR:oe,DOCTYPE_NAME:se,ERB_EXPR:te,IS_ALLOWED_URI:ae,IS_SCRIPT_OR_DATA:ie,MUSTACHE_EXPR:ee,TMPLIT_EXPR:ne});const pe=function(){return"undefined"==typeof window?null:window};!function e(){let t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:pe();const n=t=>e(t);if(n.version="3.2.3",n.removed=[],!t||!t.document||9!==t.document.nodeType)return n.isSupported=!1,n;let{document:o}=t;const r=o,a=r.currentScript,{DocumentFragment:i,HTMLTemplateElement:l,Node:s,Element:c,NodeFilter:u,NamedNodeMap:p=t.NamedNodeMap||t.MozNamedAttrMap,HTMLFormElement:d,DOMParser:f,trustedTypes:m}=t,h=c.prototype,y=H(h,"cloneNode"),g=H(h,"remove"),v=H(h,"nextSibling"),T=H(h,"childNodes"),x=H(h,"parentNode");if("function"==typeof l){const e=o.createElement("template");e.content&&e.content.ownerDocument&&(o=e.content.ownerDocument)}let w,U="";const{implementation:z,createNodeIterator:j,createDocumentFragment:ee,getElementsByTagName:te}=o,{importNode:ne}=r;let oe={afterSanitizeAttributes:[],afterSanitizeElements:[],afterSanitizeShadowDOM:[],beforeSanitizeAttributes:[],beforeSanitizeElements:[],beforeSanitizeShadowDOM:[],uponSanitizeAttribute:[],uponSanitizeElement:[],uponSanitizeShadowNode:[]};n.isSupported="function"==typeof b&&"function"==typeof x&&z&&void 0!==z.createHTMLDocument;const{MUSTACHE_EXPR:re,ERB_EXPR:ie,TMPLIT_EXPR:le,DATA_ATTR:ce,ARIA_ATTR:de,IS_SCRIPT_OR_DATA:fe,ATTR_WHITESPACE:me,CUSTOM_ELEMENT:be}=ue;let{IS_ALLOWED_URI:he}=ue,ye=null;const ge=F({},[...W,...G,...q,...V,...$]);let ve=null;const _e=F({},[...K,...Z,...J,...Q]);let Te=Object.seal(k(null,{tagNameCheck:{writable:!0,configurable:!1,enumerable:!0,value:null},attributeNameCheck:{writable:!0,configurable:!1,enumerable:!0,value:null},allowCustomizedBuiltInElements:{writable:!0,configurable:!1,enumerable:!0,value:!1}})),ke=null,xe=null,we=!0,Se=!0,Ee=!1,Ae=!0,Oe=!1,Ne=!0,Ce=!1,Le=!1,Re=!1,Me=!1,De=!1,Ie=!1,Pe=!0,Ue=!1,ze=!0,Fe=!1,je={},Be=null;const He=F({},["annotation-xml","audio","colgroup","desc","foreignobject","head","iframe","math","mi","mn","mo","ms","mtext","noembed","noframes","noscript","plaintext","script","style","svg","template","thead","title","video","xmp"]);let We=null;const Ge=F({},["audio","video","img","source","image","track"]);let qe=null;const Ye=F({},["alt","class","for","id","label","name","pattern","placeholder","role","summary","title","value","style","xmlns"]),Ve="http://www.w3.org/1998/Math/MathML",Xe="http://www.w3.org/2000/svg",$e="http://www.w3.org/1999/xhtml";let Ke=$e,Ze=!1,Je=null;const Qe=F({},[Ve,Xe,$e],N);let et=F({},["mi","mo","mn","ms","mtext"]),tt=F({},["annotation-xml"]);const nt=F({},["title","style","font","a","script"]);let ot=null;const rt=["application/xhtml+xml","text/html"];let at=null,it=null;const lt=o.createElement("form"),st=function(e){return e instanceof RegExp||e instanceof Function},ct=function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};if(!it||it!==e){if(e&&"object"==typeof e||(e={}),e=B(e),ot=-1===rt.indexOf(e.PARSER_MEDIA_TYPE)?"text/html":e.PARSER_MEDIA_TYPE,at="application/xhtml+xml"===ot?N:O,ye=D(e,"ALLOWED_TAGS")?F({},e.ALLOWED_TAGS,at):ge,ve=D(e,"ALLOWED_ATTR")?F({},e.ALLOWED_ATTR,at):_e,Je=D(e,"ALLOWED_NAMESPACES")?F({},e.ALLOWED_NAMESPACES,N):Qe,qe=D(e,"ADD_URI_SAFE_ATTR")?F(B(Ye),e.ADD_URI_SAFE_ATTR,at):Ye,We=D(e,"ADD_DATA_URI_TAGS")?F(B(Ge),e.ADD_DATA_URI_TAGS,at):Ge,Be=D(e,"FORBID_CONTENTS")?F({},e.FORBID_CONTENTS,at):He,ke=D(e,"FORBID_TAGS")?F({},e.FORBID_TAGS,at):{},xe=D(e,"FORBID_ATTR")?F({},e.FORBID_ATTR,at):{},je=!!D(e,"USE_PROFILES")&&e.USE_PROFILES,we=!1!==e.ALLOW_ARIA_ATTR,Se=!1!==e.ALLOW_DATA_ATTR,Ee=e.ALLOW_UNKNOWN_PROTOCOLS||!1,Ae=!1!==e.ALLOW_SELF_CLOSE_IN_ATTR,Oe=e.SAFE_FOR_TEMPLATES||!1,Ne=!1!==e.SAFE_FOR_XML,Ce=e.WHOLE_DOCUMENT||!1,Me=e.RETURN_DOM||!1,De=e.RETURN_DOM_FRAGMENT||!1,Ie=e.RETURN_TRUSTED_TYPE||!1,Re=e.FORCE_BODY||!1,Pe=!1!==e.SANITIZE_DOM,Ue=e.SANITIZE_NAMED_PROPS||!1,ze=!1!==e.KEEP_CONTENT,Fe=e.IN_PLACE||!1,he=e.ALLOWED_URI_REGEXP||ae,Ke=e.NAMESPACE||$e,et=e.MATHML_TEXT_INTEGRATION_POINTS||et,tt=e.HTML_INTEGRATION_POINTS||tt,Te=e.CUSTOM_ELEMENT_HANDLING||{},e.CUSTOM_ELEMENT_HANDLING&&st(e.CUSTOM_ELEMENT_HANDLING.tagNameCheck)&&(Te.tagNameCheck=e.CUSTOM_ELEMENT_HANDLING.tagNameCheck),e.CUSTOM_ELEMENT_HANDLING&&st(e.CUSTOM_ELEMENT_HANDLING.attributeNameCheck)&&(Te.attributeNameCheck=e.CUSTOM_ELEMENT_HANDLING.attributeNameCheck),e.CUSTOM_ELEMENT_HANDLING&&"boolean"==typeof e.CUSTOM_ELEMENT_HANDLING.allowCustomizedBuiltInElements&&(Te.allowCustomizedBuiltInElements=e.CUSTOM_ELEMENT_HANDLING.allowCustomizedBuiltInElements),Oe&&(Se=!1),De&&(Me=!0),je&&(ye=F({},$),ve=[],!0===je.html&&(F(ye,W),F(ve,K)),!0===je.svg&&(F(ye,G),F(ve,Z),F(ve,Q)),!0===je.svgFilters&&(F(ye,q),F(ve,Z),F(ve,Q)),!0===je.mathMl&&(F(ye,V),F(ve,J),F(ve,Q))),e.ADD_TAGS&&(ye===ge&&(ye=B(ye)),F(ye,e.ADD_TAGS,at)),e.ADD_ATTR&&(ve===_e&&(ve=B(ve)),F(ve,e.ADD_ATTR,at)),e.ADD_URI_SAFE_ATTR&&F(qe,e.ADD_URI_SAFE_ATTR,at),e.FORBID_CONTENTS&&(Be===He&&(Be=B(Be)),F(Be,e.FORBID_CONTENTS,at)),ze&&(ye["#text"]=!0),Ce&&F(ye,["html","head","body"]),ye.table&&(F(ye,["tbody"]),delete ke.tbody),e.TRUSTED_TYPES_POLICY){if("function"!=typeof e.TRUSTED_TYPES_POLICY.createHTML)throw P('TRUSTED_TYPES_POLICY configuration option must provide a "createHTML" hook.');if("function"!=typeof e.TRUSTED_TYPES_POLICY.createScriptURL)throw P('TRUSTED_TYPES_POLICY configuration option must provide a "createScriptURL" hook.');w=e.TRUSTED_TYPES_POLICY,U=w.createHTML("")}else void 0===w&&(w=function(e,t){if("object"!=typeof e||"function"!=typeof e.createPolicy)return null;let n=null;const o="data-tt-policy-suffix";t&&t.hasAttribute(o)&&(n=t.getAttribute(o));const r="dompurify"+(n?"#"+n:"");try{return e.createPolicy(r,{createHTML:e=>e,createScriptURL:e=>e})}catch(e){return console.warn("TrustedTypes policy "+r+" could not be created."),null}}(m,a)),null!==w&&"string"==typeof U&&(U=w.createHTML(""));_&&_(e),it=e}},ut=F({},[...G,...q,...Y]),pt=F({},[...V,...X]),dt=function(e){A(n.removed,{element:e});try{x(e).removeChild(e)}catch(t){g(e)}},ft=function(e,t){try{A(n.removed,{attribute:t.getAttributeNode(e),from:t})}catch(e){A(n.removed,{attribute:null,from:t})}if(t.removeAttribute(e),"is"===e)if(Me||De)try{dt(t)}catch(e){}else try{t.setAttribute(e,"")}catch(e){}},mt=function(e){let t=null,n=null;if(Re)e="<remove></remove>"+e;else{const t=C(e,/^[\r\n\t ]+/);n=t&&t[0]}"application/xhtml+xml"===ot&&Ke===$e&&(e='<html xmlns="http://www.w3.org/1999/xhtml"><head></head><body>'+e+"</body></html>");const r=w?w.createHTML(e):e;if(Ke===$e)try{t=(new f).parseFromString(r,ot)}catch(e){}if(!t||!t.documentElement){t=z.createDocument(Ke,"template",null);try{t.documentElement.innerHTML=Ze?U:r}catch(e){}}const a=t.body||t.documentElement;return e&&n&&a.insertBefore(o.createTextNode(n),a.childNodes[0]||null),Ke===$e?te.call(t,Ce?"html":"body")[0]:Ce?t.documentElement:a},bt=function(e){return j.call(e.ownerDocument||e,e,u.SHOW_ELEMENT|u.SHOW_COMMENT|u.SHOW_TEXT|u.SHOW_PROCESSING_INSTRUCTION|u.SHOW_CDATA_SECTION,null)},ht=function(e){return e instanceof d&&("string"!=typeof e.nodeName||"string"!=typeof e.textContent||"function"!=typeof e.removeChild||!(e.attributes instanceof p)||"function"!=typeof e.removeAttribute||"function"!=typeof e.setAttribute||"string"!=typeof e.namespaceURI||"function"!=typeof e.insertBefore||"function"!=typeof e.hasChildNodes)},yt=function(e){return"function"==typeof s&&e instanceof s};function gt(e,t,o){S(e,(e=>{e.call(n,t,o,it)}))}const vt=function(e){let t=null;if(gt(oe.beforeSanitizeElements,e,null),ht(e))return dt(e),!0;const o=at(e.nodeName);if(gt(oe.uponSanitizeElement,e,{tagName:o,allowedTags:ye}),e.hasChildNodes()&&!yt(e.firstElementChild)&&I(/<[/\w]/g,e.innerHTML)&&I(/<[/\w]/g,e.textContent))return dt(e),!0;if(7===e.nodeType)return dt(e),!0;if(Ne&&8===e.nodeType&&I(/<[/\w]/g,e.data))return dt(e),!0;if(!ye[o]||ke[o]){if(!ke[o]&&Tt(o)){if(Te.tagNameCheck instanceof RegExp&&I(Te.tagNameCheck,o))return!1;if(Te.tagNameCheck instanceof Function&&Te.tagNameCheck(o))return!1}if(ze&&!Be[o]){const t=x(e)||e.parentNode,n=T(e)||e.childNodes;if(n&&t)for(let o=n.length-1;o>=0;--o){const r=y(n[o],!0);r.__removalCount=(e.__removalCount||0)+1,t.insertBefore(r,v(e))}}return dt(e),!0}return e instanceof c&&!function(e){let t=x(e);t&&t.tagName||(t={namespaceURI:Ke,tagName:"template"});const n=O(e.tagName),o=O(t.tagName);return!!Je[e.namespaceURI]&&(e.namespaceURI===Xe?t.namespaceURI===$e?"svg"===n:t.namespaceURI===Ve?"svg"===n&&("annotation-xml"===o||et[o]):Boolean(ut[n]):e.namespaceURI===Ve?t.namespaceURI===$e?"math"===n:t.namespaceURI===Xe?"math"===n&&tt[o]:Boolean(pt[n]):e.namespaceURI===$e?!(t.namespaceURI===Xe&&!tt[o])&&!(t.namespaceURI===Ve&&!et[o])&&!pt[n]&&(nt[n]||!ut[n]):!("application/xhtml+xml"!==ot||!Je[e.namespaceURI]))}(e)?(dt(e),!0):"noscript"!==o&&"noembed"!==o&&"noframes"!==o||!I(/<\/no(script|embed|frames)/i,e.innerHTML)?(Oe&&3===e.nodeType&&(t=e.textContent,S([re,ie,le],(e=>{t=L(t,e," ")})),e.textContent!==t&&(A(n.removed,{element:e.cloneNode()}),e.textContent=t)),gt(oe.afterSanitizeElements,e,null),!1):(dt(e),!0)},_t=function(e,t,n){if(Pe&&("id"===t||"name"===t)&&(n in o||n in lt))return!1;if(Se&&!xe[t]&&I(ce,t));else if(we&&I(de,t));else if(!ve[t]||xe[t]){if(!(Tt(e)&&(Te.tagNameCheck instanceof RegExp&&I(Te.tagNameCheck,e)||Te.tagNameCheck instanceof Function&&Te.tagNameCheck(e))&&(Te.attributeNameCheck instanceof RegExp&&I(Te.attributeNameCheck,t)||Te.attributeNameCheck instanceof Function&&Te.attributeNameCheck(t))||"is"===t&&Te.allowCustomizedBuiltInElements&&(Te.tagNameCheck instanceof RegExp&&I(Te.tagNameCheck,n)||Te.tagNameCheck instanceof Function&&Te.tagNameCheck(n))))return!1}else if(qe[t]);else if(I(he,L(n,me,"")));else if("src"!==t&&"xlink:href"!==t&&"href"!==t||"script"===e||0!==R(n,"data:")||!We[e])if(Ee&&!I(fe,L(n,me,"")));else if(n)return!1;return!0},Tt=function(e){return"annotation-xml"!==e&&C(e,be)},kt=function(e){gt(oe.beforeSanitizeAttributes,e,null);const{attributes:t}=e;if(!t||ht(e))return;const o={attrName:"",attrValue:"",keepAttr:!0,allowedAttributes:ve,forceKeepAttr:void 0};let r=t.length;for(;r--;){const a=t[r],{name:i,namespaceURI:l,value:s}=a,c=at(i);let u="value"===i?s:M(s);if(o.attrName=c,o.attrValue=u,o.keepAttr=!0,o.forceKeepAttr=void 0,gt(oe.uponSanitizeAttribute,e,o),u=o.attrValue,!Ue||"id"!==c&&"name"!==c||(ft(i,e),u="user-content-"+u),Ne&&I(/((--!?|])>)|<\/(style|title)/i,u)){ft(i,e);continue}if(o.forceKeepAttr)continue;if(ft(i,e),!o.keepAttr)continue;if(!Ae&&I(/\/>/i,u)){ft(i,e);continue}Oe&&S([re,ie,le],(e=>{u=L(u,e," ")}));const p=at(e.nodeName);if(_t(p,c,u)){if(w&&"object"==typeof m&&"function"==typeof m.getAttributeType)if(l);else switch(m.getAttributeType(p,c)){case"TrustedHTML":u=w.createHTML(u);break;case"TrustedScriptURL":u=w.createScriptURL(u)}try{l?e.setAttributeNS(l,i,u):e.setAttribute(i,u),ht(e)?dt(e):E(n.removed)}catch(e){}}}gt(oe.afterSanitizeAttributes,e,null)},xt=function e(t){let n=null;const o=bt(t);for(gt(oe.beforeSanitizeShadowDOM,t,null);n=o.nextNode();)gt(oe.uponSanitizeShadowNode,n,null),vt(n),kt(n),n.content instanceof i&&e(n.content);gt(oe.afterSanitizeShadowDOM,t,null)};return n.sanitize=function(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},o=null,a=null,l=null,c=null;if(Ze=!e,Ze&&(e="\x3c!--\x3e"),"string"!=typeof e&&!yt(e)){if("function"!=typeof e.toString)throw P("toString is not a function");if("string"!=typeof(e=e.toString()))throw P("dirty is not a string, aborting")}if(!n.isSupported)return e;if(Le||ct(t),n.removed=[],"string"==typeof e&&(Fe=!1),Fe){if(e.nodeName){const t=at(e.nodeName);if(!ye[t]||ke[t])throw P("root node is forbidden and cannot be sanitized in-place")}}else if(e instanceof s)o=mt("\x3c!----\x3e"),a=o.ownerDocument.importNode(e,!0),1===a.nodeType&&"BODY"===a.nodeName||"HTML"===a.nodeName?o=a:o.appendChild(a);else{if(!Me&&!Oe&&!Ce&&-1===e.indexOf("<"))return w&&Ie?w.createHTML(e):e;if(o=mt(e),!o)return Me?null:Ie?U:""}o&&Re&&dt(o.firstChild);const u=bt(Fe?e:o);for(;l=u.nextNode();)vt(l),kt(l),l.content instanceof i&&xt(l.content);if(Fe)return e;if(Me){if(De)for(c=ee.call(o.ownerDocument);o.firstChild;)c.appendChild(o.firstChild);else c=o;return(ve.shadowroot||ve.shadowrootmode)&&(c=ne.call(r,c,!0)),c}let p=Ce?o.outerHTML:o.innerHTML;return Ce&&ye["!doctype"]&&o.ownerDocument&&o.ownerDocument.doctype&&o.ownerDocument.doctype.name&&I(se,o.ownerDocument.doctype.name)&&(p="<!DOCTYPE "+o.ownerDocument.doctype.name+">\n"+p),Oe&&S([re,ie,le],(e=>{p=L(p,e," ")})),w&&Ie?w.createHTML(p):p},n.setConfig=function(){ct(arguments.length>0&&void 0!==arguments[0]?arguments[0]:{}),Le=!0},n.clearConfig=function(){it=null,Le=!1},n.isValidAttribute=function(e,t,n){it||ct({});const o=at(e),r=at(t);return _t(o,r,n)},n.addHook=function(e,t){"function"==typeof t&&A(oe[e],t)},n.removeHook=function(e){return E(oe[e])},n.removeHooks=function(e){oe[e]=[]},n.removeAllHooks=function(){oe={afterSanitizeAttributes:[],afterSanitizeElements:[],afterSanitizeShadowDOM:[],beforeSanitizeAttributes:[],beforeSanitizeElements:[],beforeSanitizeShadowDOM:[],uponSanitizeAttribute:[],uponSanitizeElement:[],uponSanitizeShadowNode:[]}},n}(),window.wp.hooks,l.Component;const de=({attributes:e,setAttributes:t})=>((0,s.useSelect)((e=>{const{getView:t}=e("vayu-blocks/data"),{__experimentalGetPreviewDeviceType:n}=!!e("core/edit-post")&&e("core/edit-post");return n?n():t()}),[]),(0,p.jsx)(l.Fragment,{children:(0,p.jsx)(c.InspectorControls,{children:(0,p.jsx)(l.Fragment,{children:(0,p.jsxs)(u.PanelBody,{title:(0,r.__)("Layout Setting","vayu-blocks"),className:"th-adv-wrapper-loop-setting-panel",initialOpen:!0,children:[(0,p.jsx)(u.SelectControl,{label:(0,r.__)("Pagination Type","vayu-blocks"),value:e.paginationType,options:[{label:(0,r.__)("Load More Button","vayu-blocks"),value:"loadmorebtn"},{label:(0,r.__)("Infinite Loader","vayu-blocks"),value:"loadinfinite"}],onChange:e=>t({paginationType:e})}),(0,p.jsx)(u.TextControl,{label:(0,r.__)("Laod More Text","vayu-blocks"),value:e.loadMoreBtnText,onChange:e=>t({loadMoreBtnText:e})}),(0,p.jsx)(u.TextControl,{label:(0,r.__)("Loading Text","vayu-blocks"),value:e.loadMoreText,onChange:e=>t({loadMoreText:e})}),(0,p.jsx)(u.TextControl,{label:(0,r.__)("No More Post Text","vayu-blocks"),value:e.noMorePostText,onChange:e=>t({noMorePostText:e})})]})})})})),fe=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":3,"name":"vayu-blocks/post-pagination","title":"Post Pagination","category":"vayu-blocks","ancestor":["vayu-blocks/advance-query-loop"],"description":"Displays a paginated navigation to next/previous set of posts, when applicable.","textdomain":"vayu-blocks","attributes":{"paginationType":{"type":"string","default":"loadmorebtn"},"loadMoreText":{"type":"string","default":"loading..."},"noMorePostText":{"type":"string","default":"no more post"},"loadMoreBtnText":{"type":"string","default":"Load More"},"showLabel":{"type":"boolean","default":true}},"usesContext":["queryId","query"],"supports":{"html":false,"align":["wide","full"],"interactivity":true},"editorScript":"file:./index.js","editorStyle":"file:./index.css","style":"file:./style-index.css","viewScriptModule":"file:./view.js"}');var me={color:void 0,size:void 0,className:void 0,style:void 0,attr:void 0},be=f.createContext&&f.createContext(me),he=["attr","size","title"];function ye(){return ye=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},ye.apply(this,arguments)}function ge(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,o)}return n}function ve(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?ge(Object(n),!0).forEach((function(t){var o,r,a,i;o=e,r=t,a=n[t],i=function(e){if("object"!=typeof e||!e)return e;var t=e[Symbol.toPrimitive];if(void 0!==t){var n=t.call(e,"string");if("object"!=typeof n)return n;throw new TypeError("@@toPrimitive must return a primitive value.")}return String(e)}(r),(r="symbol"==typeof i?i:i+"")in o?Object.defineProperty(o,r,{value:a,enumerable:!0,configurable:!0,writable:!0}):o[r]=a})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):ge(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function _e(e){return e&&e.map(((e,t)=>f.createElement(e.tag,ve({key:t},e.attr),_e(e.child))))}function Te(e){return t=>f.createElement(ke,ye({attr:ve({},e.attr)},t),_e(e.child))}function ke(e){var t=t=>{var n,{attr:o,size:r,title:a}=e,i=function(e,t){if(null==e)return{};var n,o,r=function(e,t){if(null==e)return{};var n={};for(var o in e)if(Object.prototype.hasOwnProperty.call(e,o)){if(t.indexOf(o)>=0)continue;n[o]=e[o]}return n}(e,t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);for(o=0;o<a.length;o++)n=a[o],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(r[n]=e[n])}return r}(e,he),l=r||t.size||"1em";return t.className&&(n=t.className),e.className&&(n=(n?n+" ":"")+e.className),f.createElement("svg",ye({stroke:"currentColor",fill:"currentColor",strokeWidth:"0"},t.attr,o,i,{className:n,style:ve(ve({color:e.color||t.color},t.style),e.style),height:l,width:l,xmlns:"http://www.w3.org/2000/svg"}),a&&f.createElement("title",null,a),e.children)};return void 0!==be?f.createElement(be.Consumer,null,(e=>t(e))):t(me)}function xe(e){return Te({tag:"svg",attr:{viewBox:"0 0 24 24"},child:[{tag:"path",attr:{fill:"none",strokeWidth:"2",d:"M3,13 L3,11 L5,11 L5,13 L3,13 Z M11,12.9995001 L11,11 L12.9995001,11 L12.9995001,12.9995001 L11,12.9995001 Z M19,12.9995001 L19,11 L20.9995001,11 L20.9995001,12.9995001 L19,12.9995001 Z"},child:[]}]})(e)}(0,o.registerBlockType)(fe.name,{...fe,icon:(0,p.jsx)(xe,{style:{color:"#6c1bc3"}}),edit:({attributes:e,setAttributes:t})=>{const{paginationType:n}=e,o=(0,l.useMemo)((()=>[["vayu-blocks/advance-button",{className:i("post_pagination_loadmore",e.paginationType,"load-more-btn"),content:(0,r.__)("Load More","text-domain"),linkUrl:"#",paddingType:"linked",padding:5,paddingUnit:"px",buttonpaddingType:"linked",buttonpadding:10,buttonpaddingUnit:"px",fontSize:14,fontSizeUnit:"px",widthType:"inlinewidth"}]]),[n]),a=(0,c.useBlockProps)({className:i("vayu_blocks_post_pagination_wrap","is-layout-flex",e.paginationType)});return(0,p.jsxs)(p.Fragment,{children:[(0,p.jsx)(de,{attributes:e,setAttributes:t}),(0,p.jsx)("div",{...a,children:(0,p.jsx)(c.InnerBlocks,{template:o,templateLock:"all"})})]})},save:()=>(0,p.jsx)(c.InnerBlocks.Content,{})})},6942:(e,t)=>{var n;!function(){"use strict";var o={}.hasOwnProperty;function r(){for(var e="",t=0;t<arguments.length;t++){var n=arguments[t];n&&(e=i(e,a(n)))}return e}function a(e){if("string"==typeof e||"number"==typeof e)return e;if("object"!=typeof e)return"";if(Array.isArray(e))return r.apply(null,e);if(e.toString!==Object.prototype.toString&&!e.toString.toString().includes("[native code]"))return e.toString();var t="";for(var n in e)o.call(e,n)&&e[n]&&(t=i(t,n));return t}function i(e,t){return t?e?e+" "+t:e+t:e}e.exports?(r.default=r,e.exports=r):void 0===(n=function(){return r}.apply(t,[]))||(e.exports=n)}()}},n={};function o(e){var r=n[e];if(void 0!==r)return r.exports;var a=n[e]={exports:{}};return t[e](a,a.exports,o),a.exports}o.m=t,e=[],o.O=(t,n,r,a)=>{if(!n){var i=1/0;for(u=0;u<e.length;u++){for(var[n,r,a]=e[u],l=!0,s=0;s<n.length;s++)(!1&a||i>=a)&&Object.keys(o.O).every((e=>o.O[e](n[s])))?n.splice(s--,1):(l=!1,a<i&&(i=a));if(l){e.splice(u--,1);var c=r();void 0!==c&&(t=c)}}return t}a=a||0;for(var u=e.length;u>0&&e[u-1][2]>a;u--)e[u]=e[u-1];e[u]=[n,r,a]},o.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={3117:0,7153:0};o.O.j=t=>0===e[t];var t=(t,n)=>{var r,a,[i,l,s]=n,c=0;if(i.some((t=>0!==e[t]))){for(r in l)o.o(l,r)&&(o.m[r]=l[r]);if(s)var u=s(o)}for(t&&t(n);c<i.length;c++)a=i[c],o.o(e,a)&&e[a]&&e[a][0](),e[a]=0;return o.O(u)},n=globalThis.webpackChunkvayu_blocks=globalThis.webpackChunkvayu_blocks||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))})();var r=o.O(void 0,[7153],(()=>o(4943)));r=o.O(r)})();