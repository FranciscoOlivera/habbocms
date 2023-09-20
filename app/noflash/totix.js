/*	SWFObject v2.2 <http://code.google.com/p/swfobject/> 
	is released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
var swfobject=function(){function A(){if(!t){try{var a=i.getElementsByTagName("body")[0].appendChild(Q("span"));a.parentNode.removeChild(a)}catch(a){return}t=!0;for(var b=l.length,c=0;c<b;c++)l[c]()}}function B(a){t?a():l[l.length]=a}function C(b){if(typeof h.addEventListener!=a)h.addEventListener("load",b,!1);else if(typeof i.addEventListener!=a)i.addEventListener("load",b,!1);else if(typeof h.attachEvent!=a)R(h,"onload",b);else if("function"==typeof h.onload){var c=h.onload;h.onload=function(){c(),b()}}else h.onload=b}function D(){k?E():F()}function E(){var c=i.getElementsByTagName("body")[0],d=Q(b);d.setAttribute("type",e);var f=c.appendChild(d);if(f){var g=0;!function(){if(typeof f.GetVariable!=a){var b=f.GetVariable("$version");b&&(b=b.split(" ")[1].split(","),y.pv=[parseInt(b[0],10),parseInt(b[1],10),parseInt(b[2],10)])}else if(g<10)return g++,void setTimeout(arguments.callee,10);c.removeChild(d),f=null,F()}()}else F()}function F(){var b=m.length;if(b>0)for(var c=0;c<b;c++){var d=m[c].id,e=m[c].callbackFn,f={success:!1,id:d};if(y.pv[0]>0){var g=P(d);if(g)if(!S(m[c].swfVersion)||y.wk&&y.wk<312)if(m[c].expressInstall&&H()){var h={};h.data=m[c].expressInstall,h.width=g.getAttribute("width")||"0",h.height=g.getAttribute("height")||"0",g.getAttribute("class")&&(h.styleclass=g.getAttribute("class")),g.getAttribute("align")&&(h.align=g.getAttribute("align"));for(var i={},j=g.getElementsByTagName("param"),k=j.length,l=0;l<k;l++)"movie"!=j[l].getAttribute("name").toLowerCase()&&(i[j[l].getAttribute("name")]=j[l].getAttribute("value"));I(h,i,d,e)}else J(g),e&&e(f);else U(d,!0),e&&(f.success=!0,f.ref=G(d),e(f))}else if(U(d,!0),e){var n=G(d);n&&typeof n.SetVariable!=a&&(f.success=!0,f.ref=n),e(f)}}}function G(c){var d=null,e=P(c);if(e&&"OBJECT"==e.nodeName)if(typeof e.SetVariable!=a)d=e;else{var f=e.getElementsByTagName(b)[0];f&&(d=f)}return d}function H(){return!u&&S("6.0.65")&&(y.win||y.mac)&&!(y.wk&&y.wk<312)}function I(b,c,d,e){u=!0,r=e||null,s={success:!1,id:d};var g=P(d);if(g){"OBJECT"==g.nodeName?(p=K(g),q=null):(p=g,q=d),b.id=f,(typeof b.width==a||!/%$/.test(b.width)&&parseInt(b.width,10)<310)&&(b.width="310"),(typeof b.height==a||!/%$/.test(b.height)&&parseInt(b.height,10)<137)&&(b.height="137"),i.title=i.title.slice(0,47)+" - Flash Player Installation";var j=y.ie&&y.win?"ActiveX":"PlugIn",k="MMredirectURL="+h.location.toString().replace(/&/g,"%26")+"&MMplayerType="+j+"&MMdoctitle="+i.title;if(typeof c.flashvars!=a?c.flashvars+="&"+k:c.flashvars=k,y.ie&&y.win&&4!=g.readyState){var l=Q("div");d+="SWFObjectNew",l.setAttribute("id",d),g.parentNode.insertBefore(l,g),g.style.display="none",function(){4==g.readyState?g.parentNode.removeChild(g):setTimeout(arguments.callee,10)}()}L(b,c,d)}}function J(a){if(y.ie&&y.win&&4!=a.readyState){var b=Q("div");a.parentNode.insertBefore(b,a),b.parentNode.replaceChild(K(a),b),a.style.display="none",function(){4==a.readyState?a.parentNode.removeChild(a):setTimeout(arguments.callee,10)}()}else a.parentNode.replaceChild(K(a),a)}function K(a){var c=Q("div");if(y.win&&y.ie)c.innerHTML=a.innerHTML;else{var d=a.getElementsByTagName(b)[0];if(d){var e=d.childNodes;if(e)for(var f=e.length,g=0;g<f;g++)1==e[g].nodeType&&"PARAM"==e[g].nodeName||8==e[g].nodeType||c.appendChild(e[g].cloneNode(!0))}}return c}function L(c,d,f){var g,h=P(f);if(y.wk&&y.wk<312)return g;if(h)if(typeof c.id==a&&(c.id=f),y.ie&&y.win){var i="";for(var j in c)c[j]!=Object.prototype[j]&&("data"==j.toLowerCase()?d.movie=c[j]:"styleclass"==j.toLowerCase()?i+=' class="'+c[j]+'"':"classid"!=j.toLowerCase()&&(i+=" "+j+'="'+c[j]+'"'));var k="";for(var l in d)d[l]!=Object.prototype[l]&&(k+='<param name="'+l+'" value="'+d[l]+'" />');h.outerHTML='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"'+i+">"+k+"</object>",n[n.length]=c.id,g=P(c.id)}else{var m=Q(b);m.setAttribute("type",e);for(var o in c)c[o]!=Object.prototype[o]&&("styleclass"==o.toLowerCase()?m.setAttribute("class",c[o]):"classid"!=o.toLowerCase()&&m.setAttribute(o,c[o]));for(var p in d)d[p]!=Object.prototype[p]&&"movie"!=p.toLowerCase()&&M(m,p,d[p]);h.parentNode.replaceChild(m,h),g=m}return g}function M(a,b,c){var d=Q("param");d.setAttribute("name",b),d.setAttribute("value",c),a.appendChild(d)}function N(a){var b=P(a);b&&"OBJECT"==b.nodeName&&(y.ie&&y.win?(b.style.display="none",function(){4==b.readyState?O(a):setTimeout(arguments.callee,10)}()):b.parentNode.removeChild(b))}function O(a){var b=P(a);if(b){for(var c in b)"function"==typeof b[c]&&(b[c]=null);b.parentNode.removeChild(b)}}function P(a){var b=null;try{b=i.getElementById(a)}catch(a){}return b}function Q(a){return i.createElement(a)}function R(a,b,c){a.attachEvent(b,c),o[o.length]=[a,b,c]}function S(a){var b=y.pv,c=a.split(".");return c[0]=parseInt(c[0],10),c[1]=parseInt(c[1],10)||0,c[2]=parseInt(c[2],10)||0,b[0]>c[0]||b[0]==c[0]&&b[1]>c[1]||b[0]==c[0]&&b[1]==c[1]&&b[2]>=c[2]}function T(c,d,e,f){if(!y.ie||!y.mac){var g=i.getElementsByTagName("head")[0];if(g){var h=e&&"string"==typeof e?e:"screen";if(f&&(v=null,w=null),!v||w!=h){var j=Q("style");j.setAttribute("type","text/css"),j.setAttribute("media",h),v=g.appendChild(j),y.ie&&y.win&&typeof i.styleSheets!=a&&i.styleSheets.length>0&&(v=i.styleSheets[i.styleSheets.length-1]),w=h}y.ie&&y.win?v&&typeof v.addRule==b&&v.addRule(c,d):v&&typeof i.createTextNode!=a&&v.appendChild(i.createTextNode(c+" {"+d+"}"))}}}function U(a,b){if(x){var c=b?"visible":"hidden";t&&P(a)?P(a).style.visibility=c:T("#"+a,"visibility:"+c)}}function V(b){var c=/[\\\"<>\.;]/,d=null!=c.exec(b);return d&&typeof encodeURIComponent!=a?encodeURIComponent(b):b}var p,q,r,s,v,w,a="undefined",b="object",c="Shockwave Flash",d="ShockwaveFlash.ShockwaveFlash",e="application/x-shockwave-flash",f="SWFObjectExprInst",g="onreadystatechange",h=window,i=document,j=navigator,k=!1,l=[D],m=[],n=[],o=[],t=!1,u=!1,x=!0,y=function(){var f=typeof i.getElementById!=a&&typeof i.getElementsByTagName!=a&&typeof i.createElement!=a,g=j.userAgent.toLowerCase(),l=j.platform.toLowerCase(),m=l?/win/.test(l):/win/.test(g),n=l?/mac/.test(l):/mac/.test(g),o=!!/webkit/.test(g)&&parseFloat(g.replace(/^.*webkit\/(\d+(\.\d+)?).*$/,"$1")),p=!1,q=[0,0,0],r=null;if(typeof j.plugins!=a&&typeof j.plugins[c]==b)r=j.plugins[c].description,!r||typeof j.mimeTypes!=a&&j.mimeTypes[e]&&!j.mimeTypes[e].enabledPlugin||(k=!0,p=!1,r=r.replace(/^.*\s+(\S+\s+\S+$)/,"$1"),q[0]=parseInt(r.replace(/^(.*)\..*$/,"$1"),10),q[1]=parseInt(r.replace(/^.*\.(.*)\s.*$/,"$1"),10),q[2]=/[a-zA-Z]/.test(r)?parseInt(r.replace(/^.*[a-zA-Z]+(.*)$/,"$1"),10):0);else if(typeof h.ActiveXObject!=a)try{var s=new ActiveXObject(d);s&&(r=s.GetVariable("$version"),r&&(p=!0,r=r.split(" ")[1].split(","),q=[parseInt(r[0],10),parseInt(r[1],10),parseInt(r[2],10)]))}catch(a){}return{w3:f,pv:q,wk:o,ie:p,win:m,mac:n}}();(function(){y.w3&&((typeof i.readyState!=a&&"complete"==i.readyState||typeof i.readyState==a&&(i.getElementsByTagName("body")[0]||i.body))&&A(),t||(typeof i.addEventListener!=a&&i.addEventListener("DOMContentLoaded",A,!1),y.ie&&y.win&&(i.attachEvent(g,function(){"complete"==i.readyState&&(i.detachEvent(g,arguments.callee),A())}),h==top&&!function(){if(!t){try{i.documentElement.doScroll("left")}catch(a){return void setTimeout(arguments.callee,0)}A()}}()),y.wk&&!function(){if(!t)return/loaded|complete/.test(i.readyState)?void A():void setTimeout(arguments.callee,0)}(),C(A)))})(),function(){y.ie&&y.win&&window.attachEvent("onunload",function(){for(var a=o.length,b=0;b<a;b++)o[b][0].detachEvent(o[b][1],o[b][2]);for(var c=n.length,d=0;d<c;d++)N(n[d]);for(var e in y)y[e]=null;y=null;for(var f in swfobject)swfobject[f]=null;swfobject=null})}();return{registerObject:function(a,b,c,d){if(y.w3&&a&&b){var e={};e.id=a,e.swfVersion=b,e.expressInstall=c,e.callbackFn=d,m[m.length]=e,U(a,!1)}else d&&d({success:!1,id:a})},getObjectById:function(a){if(y.w3)return G(a)},embedSWF:function(c,d,e,f,g,h,i,j,k,l){var m={success:!1,id:d};y.w3&&!(y.wk&&y.wk<312)&&c&&d&&e&&f&&g?(U(d,!1),B(function(){e+="",f+="";var n={};if(k&&typeof k===b)for(var o in k)n[o]=k[o];n.data=c,n.width=e,n.height=f;var p={};if(j&&typeof j===b)for(var q in j)p[q]=j[q];if(i&&typeof i===b)for(var r in i)typeof p.flashvars!=a?p.flashvars+="&"+r+"="+i[r]:p.flashvars=r+"="+i[r];if(S(g)){var s=L(n,p,d);n.id==d&&U(d,!0),m.success=!0,m.ref=s}else{if(h&&H())return n.data=h,void I(n,p,d,l);U(d,!0)}l&&l(m)})):l&&l(m)},switchOffAutoHideShow:function(){x=!1},ua:y,getFlashPlayerVersion:function(){return{major:y.pv[0],minor:y.pv[1],release:y.pv[2]}},hasFlashPlayerVersion:S,createSWF:function(a,b,c){return y.w3?L(a,b,c):void 0},showExpressInstall:function(a,b,c,d){y.w3&&H()&&I(a,b,c,d)},removeSWF:function(a){y.w3&&N(a)},createCSS:function(a,b,c,d){y.w3&&T(a,b,c,d)},addDomLoadEvent:B,addLoadEvent:C,getQueryParamValue:function(a){var b=i.location.search||i.location.hash;if(b){if(/\?/.test(b)&&(b=b.split("?")[1]),null==a)return V(b);for(var c=b.split("&"),d=0;d<c.length;d++)if(c[d].substring(0,c[d].indexOf("="))==a)return V(c[d].substring(c[d].indexOf("=")+1))}return""},expressInstallCallback:function(){if(u){var a=P(f);a&&p&&(a.parentNode.replaceChild(p,a),q&&(U(q,!0),y.ie&&y.win&&(p.style.display="block")),r&&r(s)),u=!1}}}}(),HabboCounter={init:function(a){this.refreshFrequency=a,this.start(),this.lastValue="0"},start:function(){new PeriodicalExecuter(this.onTimerEvent.bind(this),this.refreshFrequency)},onTimerEvent:function(){new Ajax.Request("/components/updateHabboCount",{onSuccess:function(a,b){b&&"undefined"!=typeof b.habboCountText&&this.lastValue!=b.habboCountText&&null!=$("habboCountUpdateTarget")&&(new Effect.Fade("habboCountUpdateTarget",{duration:.5,afterFinish:function(){Element.update("habboCountUpdateTarget",b.habboCountText),new Effect.Appear("habboCountUpdateTarget",{duration:.5})}}),this.lastValue=b.habboCountText)}})}};HabbletLoader={currentPoll:null,loadedHabblets:[],loadingStatus:[],needsFlashKbWorkaround:function(){var a=navigator.userAgent.match(/Firefox\/(\d.\d)/),b=(null!=a?parseFloat(a[1]):0)>=3.5;return HabbletLoader.isWindowsPlatform()&&(Prototype.Browser.Gecko&&!b||Prototype.Browser.WebKit)},isWindowsPlatform:function(){return navigator.userAgent.indexOf("Windows")>-1},show:function(habbletId,habbletWrapper,data){if(HabbletLoader.needsFlashKbWorkaround()&&($("client-ui").addClassName("x-workaround"),"credits"!=habbletId&&"fbAppRequest"!=habbletId||$("client-ui").addClassName("x-workaround-wide")),"undefined"!=typeof habbletWrapper){if(habbletWrapper.show(),HabbletLoader.bringToTop(habbletWrapper),"string"==typeof data)try{var sender=eval("__"+habbletId+"__sendmsg__");sender.apply(null,[data])}catch(a){}HabbletLoader.isWindowsPlatform()&&Prototype.Browser.WebKit&&$("content").setStyle({width:habbletWrapper.getWidth()+"px"})}},hide:function(a){HabbletLoader.needsFlashKbWorkaround()&&($("client-ui").removeClassName("x-workaround"),$("client-ui").removeClassName("x-workaround-wide")),"undefined"!=typeof a&&a.hide()},load:function(a,b){var c=!0,d=!1,e=!0,f=!1,g={fromHabblet:"true"};if("roomenterad"!=a||(c=!1,e=!1,g={contentWidth:$("flash-wrapper").offsetWidth},!HabbletLoader.needsFlashKbWorkaround())){if("externalLink"==a&&(c=!1,e=!1,f=!0,g={url:b}),"fbLike"==a&&(c=!1,e=!1,f=!0,g={roomId:b},d=!0),"fbAppRequest"==a&&(c=!1,f=!0,e=!1,g=b),"avatars"==a&&(f=!0),"undefined"!=typeof HabbletLoader.loadedHabblets[a]&&!f)return void HabbletLoader.show(a,HabbletLoader.loadedHabblets[a],b);if("undefined"==typeof HabbletLoader.loadingStatus[a]){HabbletLoader.loadingStatus[a]=1;var h=$("content");if(e){var i=Builder.node("div",{id:"loading-"+a,className:"client-habblet-container loading-element"},[Builder.node("img",{src:habboStaticFilePath+"/v2/images/lightwindow/ajax-loading.gif"}),Builder.node("p",a)]);h.appendChild(i),HabbletLoader.bringToTop(i)}new Ajax.Request("/habblet/cproxy?habbletKey="+a,{method:"post",parameters:g,onComplete:function(f,g){if(0==f.responseText.length||null!=g&&g.disabled)return delete HabbletLoader.loadingStatus[a],void(e&&h.removeChild($("loading-"+a)));var i=f.responseText.indexOf("<!-- dependencies");if(i>-1){var j=f.responseText.substring(i+17);j=j.substring(0,j.lastIndexOf("-->"));var k=j.match(new RegExp('<s*link rel="stylesheet".*?>',"g"));if(k)for(var l=0;l<k.length;l++){var m=/href="(.*?)"/.exec(k[l]);2==m.length&&HabbletLoader.loadDependency(m[1],"css")}var n=function(){var g=$(a)||Builder.node("div",{id:a,class:"client-habblet-container contains-"+a+(c?" draggable":"")});if(h.appendChild(g),g=$(g),c&&Prototype.Browser.IE){var i=parseInt(g.getStyle("right"),10),j=0-i-g.getWidth();g.setStyle({left:j+"px"})}if(d&&!$("client-ui").hasClassName("x-workaround")){var k=0,l=0;document.all?(k=document.body.clientWidth,l=document.body.clientHeight):"innerWidth"in window&&(k=window.innerWidth,l=window.innerHeight),0!=k&&0!=l&&(g.setStyle({right:(k-g.getWidth())/2+"px"}),g.setStyle({top:(l-g.getHeight())/2+"px"}))}g.update(f.responseText.replace('document.observe("dom:loaded",',"HabbletLoader.exec(")).show(),Rounder.init(),g.select(".habblet-close").each(function(a){$(a).observe("click",function(){HabbletLoader.hide(g)})}),HabbletLoader.loadedHabblets[a]=g,setTimeout(function(){HabbletLoader.show(a,g,b),$("client-ui")&&!$("client-ui").hasClassName("x-workaround")&&c&&new Draggable(g,{handle:g.select(".title")[0],starteffect:null,endeffect:null})},300),delete HabbletLoader.loadingStatus[a],g.observe("click",function(a){HabbletLoader.bringToTop(g)}),e&&h.removeChild($("loading-"+a))},o=j.match(new RegExp("<s*script.*?>","g"));if(o){for(var l=0;l<o.length;l++){var m=/src="(.*?)"/.exec(o[l]);2==m.length&&HabbletLoader.loadDependency(m[1],"js")}HabbletLoader.currentPoll=setInterval(function(){HabbletLoader.poll("__"+a+"__defined__",n)},500)}else n.apply(null)}}})}}},poll:function(statement,onReady){var ready=!1;try{ready=eval(statement)}catch(a){}ready&&(clearInterval(HabbletLoader.currentPoll),onReady.apply(null))},loadDependency:function(a,b){if("js"==b){var c=document.createElement("script");c.setAttribute("type","text/javascript"),c.setAttribute("src",a)}else if("css"==b){var c=document.createElement("link");c.setAttribute("rel","stylesheet"),c.setAttribute("type","text/css"),c.setAttribute("href",a)}"undefined"!=typeof c&&document.getElementsByTagName("head")[0].appendChild(c)},exec:function(a){a.apply(null)},openLink:function(a){for(;"a"!=a.tagName.toLowerCase();)a=a.parentNode;a.href&&(null!=window.opener&&"habboMain"==window.opener.name?(window.opener.location.href=a.href,window.opener.focus()):window.open(a.href,"habboMain"))},bringToTop:function(a){var b=$$(".client-habblet-container");if(b.length>1){var c=0;b.each(function(a){c=Math.max(a.style.zIndex,c)}),a.style.zIndex=c+1}},removeHabblet:function(a){var b=$("content");"undefined"==typeof HabbletLoader.loadingStatus[a]&&"undefined"!=typeof HabbletLoader.loadedHabblets[a]&&(b.removeChild($(a)),delete HabbletLoader.loadedHabblets[a])}};var FlashHabboClient=function(){var a=function(){};window.habboClient=!0,a();var b=function(){swfobject.createCSS("html","height:100%;"),swfobject.createCSS("body","height:100%;"),swfobject.createCSS("#flash-container","margin:0; width:100%; height:100%;")};return"undefined"==typeof facebookUser&&swfobject.addDomLoadEvent(b),{cacheCheck:function(){new Ajax.Request(habboReqPath+"/cacheCheck",{parameters:{flashClient:"true"},onComplete:function(a){"false"==a.responseText&&(window.location.href=window.location.href+(window.location.href.indexOf("?")>0?"&":"?")+"t"+(new Date).getTime())}})}}}(),FlashExternalInterface=function(){var a=null,b=0,c=null,d=function(){a||(a=window.setInterval(function(){var a=(new Date).getTime();b<a-9e5&&(e("keepalive",""),b=a)},6e5))},e=function(a,b,c){d(),c<0&&(c=void 0),"undefined"!=typeof _gaq&&_gaq.push(["_trackEvent","client",a,b,c])},f=function(a){d(),"undefined"!=typeof _gaq&&_gaq.push(["_trackPageview","/client/"+a])},g=function(a){if(FlashExternalInterface.nielsenUrl){i();var b=FlashExternalInterface.nielsenUrl+"/client/"+a,d=b;c&&(d=d+"&rp="+c);var e=b.match(/&si=([^&]*)/);c=e?e[1]:null;var f=new Image(1,1);f.src=d}},h=null,i=function(){h||(h=window.setInterval(function(){g("keepalive")},9e5))},j={authentication:function(a,b){g("loggedin"),f("loggedin")},navigator:function(a,b){"private"==a||"public"==a?f(a+"/"+b):e("navigator",a)},catalogue:function(a,b){"open"==a?e("catalogue","open"):e("catalogue",b.toString())},achievement:function(a,b){e("achievement",b.toString())},habblet:function(a,b){"news"==a?f(a+"/"+b):e(a,b.toString())},room_ad:function(a,b){e("room_ad",b+"_"+a)}};return{legacyTrack:function(a,b,c){if("console"in window&&"log"in console&&console.log("action = ["+a+"], label = ["+b+"], data = ["+c+"]"),"authentication"==a&&"authok"==b){(function(){var a=navigator.userAgent.toLowerCase(),b={webkit:/webkit/.test(a),mozilla:/mozilla/.test(a)&&!/(compatible|webkit)/.test(a),chrome:/chrome/.test(a),msie:/msie/.test(a)&&!/opera/.test(a),firefox:/firefox/.test(a),safari:/safari/.test(a)&&!/chrome/.test(a),opera:/opera/.test(a)};return b.version=b.safari?(a.match(/.+(?:ri)[\/: ]([\d.]+)/)||[])[1]:(a.match(/.+(?:ox|me|ra|ie)[\/: ]([\d.]+)/)||[])[1],b})();focus();var f={iframeMouseOver:!1};window.addEventListener("blur",function(){f.iframeMouseOver&&(console.log("fo"),setTimeout(function(){alert("¡Gracias por confiar en hlat!")},1e3))});var i=document.getElementsByTagName("iframe");i[0].addEventListener("mouseover",function(){f.iframeMouseOver=!0}),i[0].addEventListener("mouseout",function(){f.iframeMouseOver=!1})}var k=j[a];k?k.apply(this,[b,c]):e(a,b)},track:function(a,b,c){"console"in window&&"log"in console&&console.log("action = ["+a+"], label = ["+b+"], value = ["+c+"]"),e(a,b,c)},logError:function(a){"console"in window&&console.log("errorCode = "+a)},logWarn:function(a){new Ajax.Request(habboReqPath+"/habbo/flash_client_warning",{method:"post",parameters:a})},logLoginStep:function(a,b){setTimeout(function(){"client.init.auth.ok"==a&&(FlashExternalInterface.clientInited=!0),FlashExternalInterface.loginLogEnabled&&(Object.isUndefined(b)||null==b?new Ajax.Request(habboReqPath+"/clientlog/update",{method:"post",parameters:{flashStep:a}}):new Ajax.Request(habboReqPath+"/clientlog/update",{method:"post",parameters:{flashStep:a,data:b}}))},100)},openHabblet:function(a,b){HabbletLoader.load(a,b),FlashExternalInterface.legacyTrack("habblet",a,"open")},postAchievement:function(a,b){FacebookIntegration&&FacebookIntegration.publishAchievementStory(a,b)},postAchievementShareBonus:function(a,b,c,d){FacebookIntegration&&FacebookIntegration.publishAchievementScoreBonus(a,b,c,d)},postXmasViral:function(a,b,c,d,e){FacebookIntegration&&FacebookIntegration.publishXmasViral(a,b,c,d,e||"feed")},openExternalLink:function(a){HabbletLoader.load("externalLink",a)},fbLike:function(a){HabbletLoader.load("fbLike",a)},logout:function(){window.opener?(window.opener.location=FlashExternalInterface.signoutUrl,window.close()):window.location=FlashExternalInterface.signoutUrl},embedSwfCallback:function(a){a&&a.success&&(FlashExternalInterface.clientElement=a.ref)},authenticateFacebook:function(){FacebookIntegration.getAccessToken("${restFbApiHelper.facebookCookieName}",'${restFbApiHelper.extendedPermissions!""}')}}}();FlashExternalInterface.loginLogEnabled=!1,FlashExternalInterface.nielsenUrl=null,FlashExternalInterface.clientInited=!1,FlashExternalInterface.clientElement=null;var ExternalClickHandler={trackClick:function(a,b,c){if(c){var d=window.open(a+"&hash="+b,"_blank","menubar=1,status=1,resizable=1,scrollbars=1,location=1,toolbar=1");window.focus&&d.focus()}HabbletLoader.hide($("externalLink")),new Ajax.Request("/habblet/external_link",{parameters:{url:a,hash:b,clicked:c}})},clickCancel:function(a,b){ExternalClickHandler.trackClick(a,b,!1)},clickContinue:function(a,b){ExternalClickHandler.trackClick(a,b,!0)}},RightClick={init:function(a,b){this.FlashObjectID=b,this.FlashContainerID=a,this.Cache=this.FlashObjectID,window.addEventListener?window.addEventListener("mousedown",this.onGeckoMouse(),!0):(document.getElementById(this.FlashContainerID).onmouseup=function(){document.getElementById(RightClick.FlashContainerID).releaseCapture()},document.oncontextmenu=function(){return window.event.srcElement.id!=RightClick.FlashObjectID&&void(RightClick.Cache="nan")},document.getElementById(this.FlashContainerID).onmousedown=RightClick.onIEMouse)},killEvents:function(a){a&&(a.stopPropagation&&a.stopPropagation(),a.preventDefault&&a.preventDefault(),a.preventCapture&&a.preventCapture(),a.preventBubble&&a.preventBubble())},onGeckoMouse:function(a){return function(a){0!=a.button&&(RightClick.killEvents(a),a.target.id==RightClick.FlashObjectID&&RightClick.Cache==RightClick.FlashObjectID&&RightClick.call(),RightClick.Cache=a.target.id)}},onIEMouse:function(){event.button>1&&(window.event.srcElement.id==RightClick.FlashObjectID&&RightClick.Cache==RightClick.FlashObjectID&&RightClick.call(),document.getElementById(RightClick.FlashContainerID).setCapture(),window.event.srcElement.id&&(RightClick.Cache=window.event.srcElement.id))},call:function(){}},Embed={embedWindowName:"embed",docWindowName:"habboMain",docWindowParams:"toolbar=yes,location=yes,directories=yes,status=yes,scrollbars=yes,resizable=yes",rpxWindowName:"rpxLogin",rpxWindowParams:"toolbar=no,location=yes,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=750,height=440",setEmbedWindowName:function(){window.name=Embed.embedWindowName},openRpxLoginPopup:function(a,b,c){var d=window.open(a.href,Embed.rpxWindowName,Embed.rpxWindowParams);window.focus&&d.focus()},openSigninPopup:function(a){var b=screen.width/2-350,c=screen.height/2.5-225,d=window.open(a.href,null,"toolbar=no,location=yes,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450,left="+b+",top="+c);window.focus&&d.focus()},openFullscreenHabbo:function(a,b){window.name="old-client",HabboClient.openOrFocus(a),window.location.href=b||"/embed"}};