(()=>{document.addEventListener("DOMContentLoaded",(function(){const e=document.querySelectorAll(".wp-block-vayu-blocks-timeline-child"),t=document.querySelector(".vayu-blocks-connector-scroll"),o=()=>{const o=[];e.forEach(((e,t)=>{const n=e.getBoundingClientRect();n.top>=0&&n.bottom<=window.innerHeight&&o.push(t+1)}));let n=o[o.length-1]/e.length*100;n<100&&(n+=10),isNaN(n)&&(n=100),t&&(t.style.height=`${n}%`,t.style.transform=`scaleY(${n/100})`),e.forEach(((e,t)=>{const n=e.querySelector(".vayu_blocks-timeline__marker"),c=Math.max(...o);n&&(t+1<=c?(n.style.backgroundColor="var(--icon-active-color)",n.style.fill="var(--icon-icon-active-color)"):(n.style.backgroundColor="",n.style.fill=""))}))};window.addEventListener("scroll",o),o()}));const e=document.querySelector(".vayu_blocks_touch_class .wp-block-vayu-blocks-advance-timeline");let t,o,n=!1;e&&(e.addEventListener("mousedown",(c=>{n=!0,t=c.pageX-e.offsetLeft,o=e.scrollLeft})),e.addEventListener("mouseleave",(()=>{n=!1})),e.addEventListener("mouseup",(()=>{n=!1})),e.addEventListener("mousemove",(c=>{if(!n)return;c.preventDefault();const l=c.pageX-e.offsetLeft-t;e.scrollLeft=o-l})),e.addEventListener("touchstart",(c=>{n=!0,t=c.touches[0].pageX-e.offsetLeft,o=e.scrollLeft})),e.addEventListener("touchend",(()=>{n=!1})),e.addEventListener("touchmove",(c=>{if(!n)return;c.preventDefault();const l=c.touches[0].pageX-e.offsetLeft-t;e.scrollLeft=o-l})))})();