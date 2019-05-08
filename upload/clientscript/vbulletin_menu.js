/*======================================================================*\
|| #################################################################### ||
|| # vBulletin 4.2.4
|| # ---------------------------------------------------------------- # ||
|| # Copyright �2000-2019 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/
vBulletin.add_event("vBmenuShow");vBulletin.add_event("vBmenuHide");function vB_Popup_Handler(){this.open_steps=10;this.open_fade=false;this.active=false;this.menus=new Array();this.activemenu=null;this.suggest=null}vB_Popup_Handler.prototype.activate=function(A){this.active=A;console.log("vBmenu :: System Activated")};vB_Popup_Handler.prototype.register=function(D,A,C){this.menus[D]=new vB_Popup_Menu(D,A,C);var B=YAHOO.util.Dom.get("usercss");if(B&&YAHOO.util.Dom.isAncestor(B,D)){this.menus[D].imgsrc=IMGDIR_MISC+"/black_downward_arrow.png"}this.menus[D].startup();return this.menus[D]};vB_Popup_Handler.prototype.register_suggest=function(B,A){this.suggest=new vB_Popup_Suggest(B,A);return this.suggest};vB_Popup_Handler.prototype.hide=function(){if(this.activemenu!=null){this.menus[this.activemenu].hide()}if(this.suggest!=null){this.suggest.hide()}};var vBmenu=new vB_Popup_Handler();function vbmenu_hide(A){if(A&&A.button&&A.button!=1&&A.type=="click"){return true}else{vBmenu.hide()}}function vB_Popup_Menu(C,A,B){this.controlkey=C;this.noimage=A;this.noslide=B;this.menuname=this.controlkey.split(".")[0]+"_menu";this.imgsrc=IMGDIR_MISC+"/black_downward_arrow.png"}vB_Popup_Menu.prototype.startup=function(){this.init_control(this.noimage);if(fetch_object(this.menuname)){this.init_menu()}this.slide_open=(this.noslide?false:true);this.open_steps=vBmenu.open_steps;vBulletin.add_event("vBmenuShow_"+this.controlkey);vBulletin.add_event("vBmenuHide_"+this.controlkey)};vB_Popup_Menu.prototype.init_control=function(A){this.controlobj=fetch_object(this.controlkey);this.controlobj.state=false;if(this.controlobj.firstChild&&(this.controlobj.firstChild.tagName=="TEXTAREA"||this.controlobj.firstChild.tagName=="INPUT")){}else{if(!A&&!(is_mac&&is_ie)){var C=document.createTextNode(" ");this.controlobj.appendChild(C);var B=document.createElement("img");B.src=this.imgsrc;B.border=0;B.title="";B.alt="";B.setAttribute("style","vertical-align: middle");this.img=this.controlobj.appendChild(B)}this.controlobj.unselectable=true;if(!A){this.controlobj.style.cursor=pointer_cursor}this.controlobj.onclick=vB_Popup_Events.prototype.controlobj_onclick;this.controlobj.onmouseover=vB_Popup_Events.prototype.controlobj_onmouseover}};vB_Popup_Menu.prototype.init_menu=function(){this.menuobj=fetch_object(this.menuname);this.select_handler=new vB_Select_Overlay_Handler(this.menuobj);if(this.menuobj&&!this.menuobj.initialized){this.menuobj.initialized=true;this.menuobj.onclick=e_by_gum;this.menuobj.style.position="absolute";this.menuobj.style.zIndex=50;if(is_ie&&!is_mac){if(YAHOO.env.ua.ie<7){this.menuobj.style.filter+="alpha(enabled=1,opacity=100)"}else{this.menuobj.style.minHeight="1%"}}this.init_menu_contents()}};vB_Popup_Menu.prototype.init_menu_contents=function(){var E=new Array("td","li");for(var D=0;D<E.length;D++){var H=fetch_tags(this.menuobj,E[D]);for(var F=0;F<H.length;F++){if(H[F].className=="vbmenu_option"){if(H[F].title&&H[F].title=="nohilite"){H[F].title=""}else{H[F].controlkey=this.controlkey;H[F].onmouseover=vB_Popup_Events.prototype.menuoption_onmouseover;H[F].onmouseout=vB_Popup_Events.prototype.menuoption_onmouseout;var C=fetch_tags(H[F],"a");if(C.length==1){H[F].className=H[F].className+" vbmenu_option_alink";H[F].islink=true;var B=C[0];var A=false;H[F].target=B.getAttribute("target");if(typeof B.onclick=="function"){H[F].ofunc=B.onclick;H[F].onclick=vB_Popup_Events.prototype.menuoption_onclick_function;A=true}else{if(typeof H[F].onclick=="function"){H[F].ofunc=H[F].onclick;H[F].onclick=vB_Popup_Events.prototype.menuoption_onclick_function;A=true}else{H[F].href=B.href;H[F].onclick=vB_Popup_Events.prototype.menuoption_onclick_link}}if(A){var G=document.createElement("a");G.innerHTML=B.innerHTML;G.href="#";G.onclick=function(I){I=I?I:window.event;I.returnValue=false;return false};H[F].insertBefore(G,B);H[F].removeChild(B)}}else{if(typeof H[F].onclick=="function"){H[F].ofunc=H[F].onclick;H[F].onclick=vB_Popup_Events.prototype.menuoption_onclick_function}}}}if(H[F].title=="nohilite"){H[F].title=""}}}};vB_Popup_Menu.prototype.show=function(B,A){if(!vBmenu.active){return false}else{if(!this.menuobj){this.init_menu()}}if(!this.menuobj||vBmenu.activemenu==this.controlkey){return false}console.log("vBmenu :: Show '%s'",this.controlkey);if(vBmenu.activemenu!=null&&vBmenu.activemenu!=this.controlkey){vBmenu.menus[vBmenu.activemenu].hide()}if(vBmenu.suggest!=null){vBmenu.suggest.hide()}vBmenu.activemenu=this.controlkey;this.menuobj.style.display="";if(this.slide_open){this.menuobj.style.clip="rect(auto, 0px, 0px, auto)"}this.set_menu_position(B);if(!A&&this.slide_open){this.intervalX=Math.ceil(this.menuobj.offsetWidth/this.open_steps);this.intervalY=Math.ceil(this.menuobj.offsetHeight/this.open_steps);this.slide((this.direction=="left"?0:this.menuobj.offsetWidth),0,0)}else{if(this.menuobj.style.clip&&this.slide_open){this.menuobj.style.clip="rect(auto, auto, auto, auto)"}}this.select_handler.hide();if(this.controlobj.editorid){this.controlobj.state=true;vB_Editor[this.controlobj.editorid].menu_context(this.controlobj,"mousedown")}vBulletin.events["vBmenuShow_"+this.controlkey].fire(this.controlkey);vBulletin.events.vBmenuShow.fire(this.controlkey)};vB_Popup_Menu.prototype.set_menu_position=function(A){var B=YAHOO.util.Dom.getXY(A);this.leftpx=B[0];this.toppx=B[1]+A.offsetHeight;if(((this.leftpx+this.menuobj.offsetWidth)>=document.body.clientWidth)&&((this.leftpx+A.offsetWidth-this.menuobj.offsetWidth)>0)){this.leftpx=this.leftpx+A.offsetWidth-this.menuobj.offsetWidth;this.direction="right"}else{this.direction="left"}if(this.controlkey.match(/^pagenav\.\d+$/)){A.appendChild(this.menuobj)}YAHOO.util.Dom.setXY(this.menuobj,[this.leftpx,this.toppx])};vB_Popup_Menu.prototype.hide=function(A){if(A&&A.button&&A.button!=1){return true}console.log("vBmenu :: Hide '%s'",this.controlkey);this.stop_slide();this.menuobj.style.display="none";this.select_handler.show();if(this.controlobj.editorid){this.controlobj.state=false;vB_Editor[this.controlobj.editorid].menu_context(this.controlobj,"mouseout")}vBmenu.activemenu=null;vBulletin.events["vBmenuHide_"+this.controlkey].fire(this.controlkey);vBulletin.events.vBmenuHide.fire(this.controlkey)};vB_Popup_Menu.prototype.hover=function(A){if(vBmenu.activemenu!=null){if(vBmenu.menus[vBmenu.activemenu].controlkey!=this.id){this.show(A,true)}}};vB_Popup_Menu.prototype.slide=function(C,B,A){if(this.direction=="left"&&(C<this.menuobj.offsetWidth||B<this.menuobj.offsetHeight)){C+=this.intervalX;B+=this.intervalY;this.menuobj.style.clip="rect(auto, "+C+"px, "+B+"px, auto)";this.slidetimer=setTimeout("vBmenu.menus[vBmenu.activemenu].slide("+C+", "+B+", "+A+");",0)}else{if(this.direction=="right"&&(C>0||B<this.menuobj.offsetHeight)){C-=this.intervalX;B+=this.intervalY;this.menuobj.style.clip="rect(auto, "+this.menuobj.offsetWidth+"px, "+B+"px, "+C+"px)";this.slidetimer=setTimeout("vBmenu.menus[vBmenu.activemenu].slide("+C+", "+B+", "+A+");",0)}else{this.stop_slide()}}};vB_Popup_Menu.prototype.stop_slide=function(){clearTimeout(this.slidetimer);this.menuobj.style.clip="rect(auto, auto, auto, auto)"};function vB_Popup_Events(){}vB_Popup_Events.prototype.controlobj_onclick=function(A){if(typeof do_an_e=="function"){do_an_e(A);if(vBmenu.activemenu==null||vBmenu.menus[vBmenu.activemenu].controlkey!=this.id){vBmenu.menus[this.id].show(this)}else{vBmenu.menus[this.id].hide()}}};vB_Popup_Events.prototype.controlobj_onmouseover=function(A){if(typeof do_an_e=="function"){do_an_e(A);vBmenu.menus[this.id].hover(this)}};vB_Popup_Events.prototype.menuoption_onclick_function=function(A){this.ofunc(A);vBmenu.menus[this.controlkey].hide()};vB_Popup_Events.prototype.menuoption_onclick_link=function(A){A=A?A:window.event;A.cancelBubble=true;if(A.stopPropagation){A.stopPropagation()}if(A.preventDefault){A.preventDefault()}if(A.shiftKey||(this.target!=null&&this.target!=""&&this.target.toLowerCase()!="_self")){if(this.target!=null&&this.target.charAt(0)!="_"){window.open(this.href,this.target)}else{window.open(this.href)}}else{window.location=this.href}vBmenu.menus[this.controlkey].hide();return false};vB_Popup_Events.prototype.menuoption_onmouseover=function(A){this.className="vbmenu_hilite"+(this.islink?" vbmenu_hilite_alink":"");this.style.cursor=pointer_cursor};vB_Popup_Events.prototype.menuoption_onmouseout=function(A){this.className="vbmenu_option"+(this.islink?" vbmenu_option_alink":"");this.style.cursor="default"};function vB_Popup_Suggest(B,A){this.controlkey=B;this.noslide=A;this.menuname=this.controlkey.split(".")[0]+"_menu";this.startup()}vB_Popup_Suggest.prototype.init_menu=vB_Popup_Menu.prototype.init_menu;vB_Popup_Suggest.prototype.set_menu_position=vB_Popup_Menu.prototype.set_menu_position;vB_Popup_Suggest.prototype.startup=function(){this.init_control(this.noimage);if(fetch_object(this.menuname)){this.init_menu()}this.slide_open=(this.noslide?false:true);this.open_steps=vBmenu.open_steps};vB_Popup_Suggest.prototype.init_control=function(A){this.controlobj=fetch_object(this.controlkey);this.controlobj.state=false;this.controlobj.unselectable=true;YAHOO.util.Event.addListener(this.controlobj,"click",this.controlobj_onclick,this,true)};vB_Popup_Suggest.prototype.controlobj_onclick=function(){this.hide()};vB_Popup_Suggest.prototype.init_menu_contents=function(){var E=new Array("td","li");for(var D=0;D<E.length;D++){var H=fetch_tags(this.menuobj,E[D]);for(var F=0;F<H.length;F++){if(H[F].className=="vbmenu_option"||H[F].className=="vbmenu_hilite"){if(H[F].title&&H[F].title=="nohilite"){H[F].title=""}else{H[F].controlkey=this.controlkey;var C=fetch_tags(H[F],"a");if(C.length==1){H[F].className=H[F].className+" vbmenu_option_alink";H[F].islink=true;var B=C[0];var A=false;H[F].target=B.getAttribute("target");if(typeof B.onclick=="function"){H[F].onclink=B.onclick;A=true}var G=document.createElement("a");G.innerHTML=B.innerHTML;G.href="#";G.onclick=function(I){I=I?I:window.event;I.returnValue=false;return false};H[F].insertBefore(G,B);H[F].removeChild(B)}}}}}};vB_Popup_Suggest.prototype.show=function(B,A){if(!vBmenu.active){return false}else{if(!this.menuobj){this.init_menu()}}if(!this.menuobj){return false}vBmenu.suggest=this;console.log("vBSuggest :: Show '%s'",this.controlkey);this.menuobj.style.display="";if(this.slide_open){this.menuobj.style.clip="rect(auto, 0px, 0px, auto)"}this.set_menu_position(B);if(!A&&this.slide_open){this.intervalX=Math.ceil(this.menuobj.offsetWidth/this.open_steps);this.intervalY=Math.ceil(this.menuobj.offsetHeight/this.open_steps);this.slide((this.direction=="left"?0:this.menuobj.offsetWidth),0,0)}else{if(this.menuobj.style.clip&&this.slide_open){this.menuobj.style.clip="rect(auto, auto, auto, auto)"}}this.select_handler.hide()};vB_Popup_Suggest.prototype.hide=function(A){if(A&&A.button&&A.button!=1){return true}console.log("vBSuggest :: Hide '%s'",this.controlkey);this.stop_slide();this.menuobj.style.display="none";this.select_handler.show()};vB_Popup_Suggest.prototype.slide=function(C,B,A){if(this.direction=="left"&&(C<this.menuobj.offsetWidth||B<this.menuobj.offsetHeight)){C+=this.intervalX;B+=this.intervalY;this.menuobj.style.clip="rect(auto, "+C+"px, "+B+"px, auto)";this.slidetimer=setTimeout(this.slide_call(C,B,A),0)}else{if(this.direction=="right"&&(C>0||B<this.menuobj.offsetHeight)){C-=this.intervalX;B+=this.intervalY;this.menuobj.style.clip="rect(auto, "+this.menuobj.offsetWidth+"px, "+B+"px, "+C+"px)";this.slidetimer=setTimeout(this.slide_call(C,B,A),0)}else{this.stop_slide()}}};vB_Popup_Suggest.prototype.slide_call=function(C,B,A){var D=this;return function(){return D.slide(C,B,A)}};vB_Popup_Suggest.prototype.stop_slide=function(){clearTimeout(this.slidetimer);delete this.slidetimer;this.menuobj.style.clip="rect(auto, auto, auto, auto)"};