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
var announcement_url="http://www.vbulletin.com/forum/";var membersarea_url="http://members.vbulletin.com/";if(typeof (vb_version)!="undefined"&&isNewerVersion(current_version,vb_version)){var t=fetch_object("news_table");var rowIndex=1;var t_head_r=t.insertRow(rowIndex++);t_head_c=t_head_r.insertCell(0);t_head_c.className="thead";t_head_c.innerHTML=newer_version_string.bold();var t_body_r=t.insertRow(rowIndex++);var t_body_c=t_body_r.insertCell(0);t_body_c.className="alt1";t_body_p1=document.createElement("p");t_body_p1.className="smallfont";t_body_a1=document.createElement("a");t_body_a1.href=announcement_url+"forum/vbulletin-announcements/"+vb_announcementid;t_body_a1.target="_blank";t_body_a1.innerHTML=construct_phrase(latest_string,vb_version).bold();t_body_p1.appendChild(t_body_a1);t_body_p1.innerHTML+=". "+construct_phrase(current_string,current_version.bold())+".";t_body_c.appendChild(t_body_p1);t_body_p2=document.createElement("p");t_body_p2.className="smallfont";t_body_a2=document.createElement("a");t_body_a2.href=membersarea_url;t_body_a2.target="_blank";t_body_a2.innerHTML=construct_phrase(download_string,vb_version.bold());t_body_p2.appendChild(t_body_a2);t_body_c.appendChild(t_body_p2);fetch_object("admin_news").style.display=""}function create_cp_table(B){var A=document.createElement("table");A.cellPadding=4;A.cellSpacing=0;A.border=0;A.align="center";A.width="90%";A.className="tborder";if(B){A.id=B}return A}function news_loader(G){if(G.responseXML){var H=done_table;var A=false;var E="";var K="";var S="";var N="";var B=G.responseXML.getElementsByTagName("item");t=fetch_object("news_table");A=true;fetch_object("admin_news").style.display="";var P;for(P=0;P<B.length;P++){E=B[P].getElementsByTagName("guid")[0].firstChild.nodeValue;if(PHP.in_array(E,dismissed_news)==-1){H=true;K=B[P].getElementsByTagName("title")[0].firstChild.nodeValue;S=B[P].getElementsByTagName("description")[0].firstChild.nodeValue;N=B[P].getElementsByTagName("link")[0].firstChild.nodeValue;var T=S.match(/\[local\]((?!\[\/local\]).)*\[\/local\]/g);if(T!=null){sessionurl=(SESSIONHASH==""?"":"s="+SESSIONHASH+"&");var U;for(U=0;U<T.length;U++){S=S.replace(T[U],T[U].replace(/^\[local\](.*)\.php(\??)(.*)\[\/local\]$/,"$1"+local_extension+"?"+sessionurl+"$3"))}}var Q=t.insertRow(t.rows.length);Q.id="r1_"+E;var L=Q.insertCell(0);L.className="thead";var F=document.createElement("input");F.type="submit";F.name="acpnews["+E+"]";F.className="button";if(is_ie){F.style.styleFloat=stylevar_right}else{F.style.cssFloat=stylevar_right}F.title="id="+E;F.value=dismiss_string;L.appendChild(F);var D=document.createTextNode(construct_phrase(vbulletin_news_string,K));L.appendChild(D);var O=t.insertRow(t.rows.length);O.id="r2_"+E;var J=O.insertCell(0);J.className="alt2 smallfont";J.innerHTML=S+" ";if(N&&N!="http://"){link_elem=document.createElement("a");link_elem.href=N;link_elem.target="_blank";link_elem.innerHTML=view_string.bold();J.appendChild(link_elem)}}}if(A){if(B.length){var M=t.insertRow(t.rows.length);var I=M.insertCell(0);I.className=(H?"tfoot":"alt1");I.align="center";var V=document.createElement("a");V.href=show_all_news_link;V.innerHTML=show_all_news_string;if(I.currentStyle){V.style.color=I.currentStyle.color}else{if(window.getComputedStyle&&window.getComputedStyle(I,null)){V.style.color=window.getComputedStyle(I,null).color}}I.appendChild(V)}var C=fetch_tags(fetch_object("news_table"),"td");var R="alt1";for(P=0;P<C.length;P++){if(C[P].className=="alt1"||C[P].className=="alt2"){R=C[P].className}else{if(C[P].className=="alt2 smallfont"){if(R=="alt1"){R="alt2"}else{C[P].className="alt1 smallfont";R="alt1"}}}}}}}if(AJAX_Compatible){dismissed_news=dismissed_news.split(",");YAHOO.util.Connect.asyncRequest("POST","newsproxy.php",{success:news_loader,timeout:vB_Default_Timeout},SESSIONURL)};