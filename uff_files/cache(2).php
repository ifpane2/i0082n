var HordeLogin={submit:function()
{if($('horde_user')&&!$F('horde_user')){alert(HordeLogin.user_error);$('horde_user').focus();}else if($('horde_pass')&&!$F('horde_pass')){alert(HordeLogin.pass_error);$('horde_pass').focus();}else{$('login-button').disable();if(Prototype.Browser.IE){try{document.body.style.behavior="url(#default#clientCaps)";$('ie_version').setValue(document.body.getComponentVersion("{89820200-ECBD-11CF-8B85-00AA005B4383}","componentid"));}catch(e){}}
$('login_post').setValue(1);$('horde_login').submit();}},_selectLang:function()
{if((!$('horde_user')||!$F('horde_user'))&&(!$('horde_pass')||!$F('horde_pass'))){var params={new_lang:$F('new_lang')};self.location='login.php?'+Object.toQueryString(params);}},_removeHash:function(h)
{return(Object.isString(h)&&h.startsWith("#"))?h.substring(1):h;},onDomLoad:function()
{document.observe('change',this._changeHandler.bindAsEventListener(this));document.observe('click',this._clickHandler.bindAsEventListener(this));if(location.hash){$('anchor_string').setValue(this._removeHash(location.hash));}
if($('horde_user')&&!$F('horde_user')){$('horde_user').focus();}else if($('horde_pass')&&!$F('horde_pass')){$('horde_pass').focus();}else{$('login-button').focus();}
var s=$('horde_select_view');if(s){s.down('option[value=dynamic]').show();s.down('option[value=smartmobile]').show();if(this.pre_sel){s.selectedIndex=s.down('option[value='+this.pre_sel+']').index;}}},_changeHandler:function(e)
{switch(e.element().readAttribute('id')){case'new_lang':this._selectLang();break;}},_clickHandler:function(e)
{if(e.isRightClick()){return;}
var elt=e.element();while(Object.isElement(elt)){switch(elt.readAttribute('id')){case'login-button':if(!elt.readAttribute('disabled')){this.submit();}
e.stop();break;}
elt=elt.up();}}};document.observe('dom:loaded',HordeLogin.onDomLoad.bind(HordeLogin));
var AccessKeys={macos:navigator.appVersion.indexOf("Mac")!=-1,keydownHandler:function(e)
{var elt,elts,evt,key,href;if((this.macos&&e.ctrlKey)||(!this.macos&&e.altKey&&!e.ctrlKey)){key=String.fromCharCode(e.keyCode||e.charCode).sub('"','\\"');;elts=$$('[accesskey="'+key.toUpperCase()+'"]');if(key.toUpperCase()!=key.toLowerCase()){elts=elts.concat($$('[accesskey="'+key.toLowerCase()+'"]'));}
if(elt=elts.first()){if(elts.size()>1){elts.slice(1).invoke('writeAttribute','accesskey',null);}
e.stop();if(Prototype.Browser.Opera&&elt.tagName=='LABEL'){elt=$(elt.readAttribute('for'));if(!elt){return;}}
try{elt.focus();}catch(e){}
if(navigator.userAgent.indexOf('Chrome/')>-1&&!this.macos&&elt.tagName=='A'){return;}
if(elt.tagName=='INPUT'){}else if(elt.match('A')&&elt.onclick){elt.onclick();}else if(elt.match('A')&&Prototype.Browser.IE&&(href=elt.readAttribute('href'))&&href.substr(0,1)!='#'){if(href.indexOf('javascript:')==0){eval(href.substr(11));}else{window.open(href);}}else if(document.createEvent){evt=document.createEvent('MouseEvents');evt.initMouseEvent('click',true,true,window,0,0,0,0,0,false,false,false,false,0,null);elt.dispatchEvent(evt);}else{evt=document.createEventObject();elt.fireEvent('onclick',evt);}}}}};document.observe('keydown',AccessKeys.keydownHandler.bindAsEventListener(AccessKeys));
var ImpLogin={submit:function(parentfunc)
{if($('imp_server_key')&&$F('imp_server_key').startsWith('_')){alert(this.server_key_error);$('imp_server_key').focus();return;}
parentfunc();}};HordeLogin.submit=HordeLogin.submit.wrap(ImpLogin.submit.bind(ImpLogin));
