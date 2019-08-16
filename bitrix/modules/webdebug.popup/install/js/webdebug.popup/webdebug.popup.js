function WD_PopupWindowLinkClick(Sender) {
	var ModalLocation = jQuery(Sender).attr('data-wdpopup-id');
	var ModalID = jQuery(Sender).attr('data-id');
	ModalLocation = jQuery('#'+ModalLocation);
	if (ModalLocation.WD_Popup==undefined) {
		WD_Popup_Init_Plugin();
	}
	var Params = WD_Popup_GetDataAttr(Sender);
	var ParamsTmp = {}
	for (var Param in Params) {
		if (!Params.hasOwnProperty(Param)) continue;
		ParamsTmp[WD_Popup_CapitalizeString(Param)] = Params[Param];
	}
	Params = ParamsTmp;
	ModalLocation.WD_Popup(Params);
	var CallbackOpen = jQuery(Sender).attr('data-callback-open');
	if (WD_Popup_FunctionExists(CallbackOpen) && ModalLocation.attr('data-callback-open-done')!='Y') {
		window[CallbackOpen](ModalLocation, ModalLocation.find('.wd_popup_content'), jQuery(Sender));
		ModalLocation.attr('data-callback-open-done','Y');
	}
	var CallbackShow = jQuery(Sender).attr('data-callback-show');
	if (WD_Popup_FunctionExists(CallbackShow)) {
		window[CallbackShow](ModalLocation, ModalLocation.find('.wd_popup_content'), jQuery(Sender));
	}
}

function WD_Popup_CapitalizeString(Value) {
	return Value.replace(/-([a-z])/ig, function(all, letter) {
		return letter.toUpperCase();
	});
}

function WD_Popup_GetDataAttr(Sender) {
	var obAttributes = jQuery(Sender)[0].attributes;
	var arParams = {};
	var strAttrName;
	var strAttrValue;
	for (i = 0; i < obAttributes.length; i++) {
		strAttrName = obAttributes[i].name.toLowerCase();
		if (strAttrName.indexOf('data-')==0) {
			strAttrName = strAttrName.substr(5);
			strAttrValue = obAttributes[i].value;
			if (strAttrValue == parseInt(strAttrValue)) {
				strAttrValue = parseInt(strAttrValue);
			}
			arParams[strAttrName] = strAttrValue;
		}
	}
	return arParams;
}

function WD_Popup_InArray(needle, haystack, strict) {
	var found = false, key, strict = !!strict;
	for (key in haystack) {
		if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
			found = true;
			break;
		}
	}
	return found;
}

function WD_Popups_Init() {
	if (window.WD_Popup_LinkTo!=undefined) {
		for(var i in window.WD_Popup_LinkTo) {
			if (!window.WD_Popup_LinkTo.hasOwnProperty(i)) continue;
			for(var j in window.WD_Popup_LinkTo[i]) {
				jQuery(i).attr(j,window.WD_Popup_LinkTo[i][j]);
			}
		}
	}
	var DefaultWidth = 300;
	WD_Popup_Init_Plugin();
	jQuery('[data-wdpopup-id]').each(function() {
		var modalID = jQuery(this).attr('data-wdpopup-id');
		modalLocation = jQuery('#'+modalID);
		if (jQuery(this).attr('data-move')=='Y') {
			jQuery('body').first().append(modalLocation);
		}
		var ModalWidth = parseInt(modalLocation.outerWidth());
		if (ModalWidth<0 || isNaN(ModalWidth)) ModalWidth = DefaultWidth;
		var ModalMarginLeft = parseInt(ModalWidth/2);
		if (ModalMarginLeft<0 || isNaN(ModalMarginLeft)) ModalMarginLeft = parseInt(DefaultWidth/2);
		ModalMarginLeft = -1 * ModalMarginLeft;
		modalLocation.css({'width':ModalWidth,'margin-left':ModalMarginLeft});
		var CallbackInit = modalLocation.attr('data-callback-init');
		if (WD_Popup_FunctionExists(CallbackInit)) {
			window[CallbackInit](modalLocation, modalLocation.find('.wd_popup_content'), jQuery(this));
		}
		// check cookie
		var AutoopenOnce = jQuery(this).attr('data-autoopen-once');
		if (AutoopenOnce=='Y') {
			var PopupID = jQuery(this).attr('data-id');
			var WasOpened = jQuery.wdPopupCookie('popup_'+PopupID+'_autoopened');
			if (WasOpened=='Y') {
				jQuery(this).attr('data-autoopen','N');
			}
		}
	});
	jQuery(document).delegate('[data-wdpopup-id]', 'click', function(e){
		e.preventDefault();
		WD_PopupWindowLinkClick(this);
	});
	WD_Popup_Autoopener();
	jQuery(window).resize(function(){
		// Vertical align (for fixed && middle only)
		jQuery('.wd_popup_window').each(function(){
			var IsFixed = jQuery(this).attr('data-fixed')=='Y';
			var IsMiddle = jQuery(this).attr('data-middle')=='Y';
			if (IsFixed && IsMiddle) {
				var Top = WD_Popup_GetTargetTop(jQuery(this), true, true, 0);
				jQuery(this).css('top',Top);
			}
		});
	});
}

function WD_Popup_AJAX(Container, URL, FormData, Callback) {
	if (FormData==undefined) FormData = '';
	jQuery.ajax({
		url: URL,
		type: 'POST',
		data: FormData,
		success: function(res) {
			if (typeof Callback == 'function') {
				Callback(res, Container, URL, FormData);
			}
		}
	});
}

function WD_Popup_GetContentObject(ID) {
	return jQuery('#popup_'+ID+'_window .wd_popup_content');
}

function WD_Popup_Close(ID) {
	if (ID===false) {
		jQuery('.wd_popup_window .wd_popup_close').trigger('click');
	} else {
		jQuery('#popup_'+ID+'_window .wd_popup_close').trigger('click');
	}
}

function WD_Popup_Open(ID) {
	if (ID!==false && jQuery('#wd_func_opener_'+ID).length>0) {
		jQuery('#wd_func_opener_'+ID).trigger('click');
	}
}

function WD_Popup_GetClientHeight() {
	var Height = 0; 
	if (self.innerHeight) {
		Height = self.innerHeight; 
	} else if (document.documentElement && document.documentElement.clientHeight) {
		Height = document.documentElement.clientHeight; 
	} else if (document.body) {
		Height = document.body.clientHeight; 
	}
	return Height;
}

function WD_Popup_FunctionExists(function_name) {
	if (typeof function_name == 'string'){
		return (typeof window[function_name] == 'function');
	} else{
		return (function_name instanceof Function);
	}
}

function WD_Popup_Autoopener() {
	window.WDAutoopenedWindows = [];
	jQuery('[data-wdpopup-id][data-autoopen=Y]').each(function(){
		var ID = jQuery(this).attr('data-id');
		if(window['WD_Popup_Timeout_'+ID]==undefined) {
			var Link = jQuery(this);
			var Delay = parseInt(Link.data('autoopen-delay'));
			if (isNaN(Delay) || Delay<0) Delay = 500;
			window['WD_Popup_Timeout_'+ID] = setTimeout(function(){
				if (!WD_Popup_InArray(Link.attr('data-wdpopup-id'),window.WDAutoopenedWindows)) {
					window.WDAutoopenedWindows.push(Link.attr('data-wdpopup-id'));
					Link.trigger('click');
				}
			},Delay);
		}
	});
}

function WD_Popup_OnReady(callback){
	var addListener = document.addEventListener || document.attachEvent,
			removeListener = document.removeEventListener || document.detachEvent,
			eventName = document.addEventListener ? "DOMContentLoaded" : "onreadystatechange";
	addListener.call(document, eventName, function(){
		if (document.removeEventListener) {
			document.removeEventListener(eventName,arguments.callee,false);
		} else if (document.detachEvent) {
			document.detachEvent(eventName,arguments.callee,false);
		}
		callback();
	}, false);
}

function WD_Popup_GetCurDir() {
	var arPath = window.location.pathname.split('/');
	var Path = '';
	if (arPath.length>1) {
		for (i = 1; i < arPath.length-1; i++) {
			Path += '/' + arPath[i];
		}
	}
	Path += '/';
	return Path;
}

function WD_Popup_GetTargetTop(Popup, Fixed, Middle, TopMeasure) {
	var Top;
	if (Middle) {
		var BrowserHeight = WD_Popup_GetClientHeight();
		var PaddingTop = parseInt(Popup.css('paddingTop'));
		if (isNaN(PaddingTop)) {
			PaddingTop = 0;
		}
		var PaddingBottom = parseInt(Popup.css('paddingBottom'));
		if (isNaN(PaddingBottom)) {
			PaddingBottom = 0;
		}
		var PopupHeight = Popup.height() + PaddingTop + PaddingBottom;
		Top = Math.round((BrowserHeight - PopupHeight) / 2);
	} else {
		Top = TopMeasure;
	}
	
	if (!Fixed) {
		Top = Top + jQuery(document).scrollTop();
	}
	
	return Top;
}

function WD_Popup_Init_Plugin() {
	jQuery.fn.WD_Popup = function(options) {
		var defaults = {  
			animation: 'fadeAndPop',
			animationspeed: 150,
			closeonbackgroundclick: true,
			close: '',
			noClose: '',
			overlay: '',
			overlayOpacity: 0.6,
			callbackClose:null,
			fixed:false,
			middle:false
		};
		var options = jQuery.extend({}, defaults, options);
		if (options.noClose=='Y') {
			options.closeonbackgroundclick = false;
		}
		if (options['autoopenDelay']==undefined && options['autoopen-delay']!=undefined) {
			options['autoopenDelay'] = options['autoopen-delay'];
		}
		if (options['autoopenOnce']==undefined && options['autoopen-once']!=undefined) {
			options['autoopenOnce'] = options['autoopen-once'];
		}
		if (options['autoopenTerm']==undefined && options['autoopen-term']!=undefined) {
			options['autoopenTerm'] = options['autoopen-term'];
		}
		if (options['autoopenPath']==undefined && options['autoopen-path']!=undefined) {
			options['autoopenPath'] = options['autoopen-path'];
		}
		return this.each(function() {
			if (jQuery.trim(options.overlay)=='') options.overlay = 'wd_popup_overlay_'+options.id;
			var modal = jQuery(this),
					topMeasure = parseInt(modal.css('top')),
					topOffset = modal.height() + topMeasure,
					locked = false,
					modalBG = jQuery('#'+options.overlay);
			if(this.initialTop!=undefined) {
				topMeasure = this.initialTop;
			}
			else {
				this.initialTop = topMeasure;
			}
			options.fixed = modal.attr('data-fixed')=='Y'?true:false;
			options.middle = modal.attr('data-middle')=='Y'?true:false;
			if(modalBG.length == 0) {
				modalBG = jQuery('<div id="'+options.overlay+'" class="wd_popup_overlay"></div>').insertAfter(modal);
			}
			modal.bind('wdpopup:open', function () {
				modalBG.unbind('click.modalEvent');
				jQuery('#' + options.close).unbind('click.modalEvent');
				if(!locked) {
					lockModal();
					if(options.animation == "fadeAndPop") {
						modalBG.fadeTo(options.animationspeed/2, options.overlayOpacity);
						var TopStart = jQuery(document).scrollTop()-topOffset;
						if (options.fixed) {
							TopStart = -1 * topOffset;
						}
						modal.css({'display':'block','top': TopStart, 'opacity' : 0, 'visibility' : 'visible'});
						var Top = WD_Popup_GetTargetTop(modal, options.fixed, options.middle, topMeasure);
						modal.delay(options.animationspeed/2).animate({
							"top": Top,
							"opacity" : 1
						}, options.animationspeed,unlockModal());				
					}
					if(options.animation == "fade") {
						modalBG.fadeTo(options.animationspeed/2, options.overlayOpacity);
						var Top = WD_Popup_GetTargetTop(modal, options.fixed, options.middle, topMeasure);
						modal.css({'display':'block','opacity' : 0, 'visibility' : 'visible', 'top': Top});
						modal.delay(options.animationspeed/2).animate({
							"opacity" : 1
						}, options.animationspeed,unlockModal());					
					}
					if(options.animation == "none") {
						modalBG.css({"display":"block","opacity":options.overlayOpacity});	
						var Top = WD_Popup_GetTargetTop(modal, options.fixed, options.middle, topMeasure);
						modal.css({'display':'block','visibility' : 'visible', 'top':Top});
						unlockModal();
					}
				}
				modal.unbind('wdpopup:open');
			});
			modal.bind('wdpopup:close', function () {
				var CanClose=true;
				if (options.autoopenOnce=='Y' && (options.autoopenTerm>=0 || options.autoopenTerm.match(/([\d]+)m/))) {
					var arCookieOptions = {
						path:'/',
						expires:false
					};
					if (options.autoopenTerm>0) {
						var date = new Date();
						date.setTime(date.getTime() + (options.autoopenTerm * 24 * 60 * 60 * 1000));
						arCookieOptions['expires'] = date;
					}
					else {
						var match = options.autoopenTerm.match(/([\d]+)m/);
						if(match!=null){
							var date = new Date();
							date.setTime(date.getTime() + (match[1] * 60 * 1000));
							arCookieOptions['expires'] = date;
						}
					}
					if (options.autoopenPath=='Y') {
						arCookieOptions['path'] = WD_Popup_GetCurDir();
					}
					jQuery.wdPopupCookie('popup_'+options.id+'_autoopened', 'Y', arCookieOptions);
				}
				if (WD_Popup_FunctionExists(options.callbackClose)) {
					if (window[options.callbackClose](modal, modal.find('.wd_popup_content').first())===false) {
						CanClose = false;
					}
				}
				if (CanClose) {
					if(!locked) {
						lockModal();
						if(options.animation == "fadeAndPop") {
							modalBG.delay(options.animationspeed).fadeOut(options.animationspeed);
							var Top = jQuery(document).scrollTop()-topOffset;
							if (options.fixed) {
								Top = -1 * topOffset;
							}
							modal.animate({
								"top":  Top,
								"opacity" : 0
							}, options.animationspeed/2, function() {
								modal.css({'display':'none','top':topMeasure, 'opacity' : 1, 'visibility' : 'hidden'});
								if (modal.data('display')=='none') modal.html(modal.html());
								unlockModal();
							});
						}
						if(options.animation == "fade") {
							modalBG.delay(options.animationspeed).fadeOut(options.animationspeed);
							modal.animate({
								"opacity" : 0
							}, options.animationspeed, function() {
								modal.css({'display':'none','opacity' : 1, 'visibility' : 'hidden', 'top' : topMeasure});
								if (modal.data('display')=='none') modal.html(modal.html());
								unlockModal();
							});
						}  	
						if(options.animation == "none") {
							modal.css({'display':'none','visibility' : 'hidden', 'top' : topMeasure});
							modalBG.css({'display' : 'none'});
							if (modal.data('display')=='none') modal.html(modal.html());
						}
					}
					modal.unbind('wdpopup:close');
				}
				return false;
			});
			if(modal.css('visibility')=='hidden') {
				modal.trigger('wdpopup:open');
			}
			var closeButton = jQuery('#' + options.close).bind('click.modalEvent', function () {
				modal.trigger('wdpopup:close');
				return false;
			});
			if(options.closeonbackgroundclick) {
				modalBG.css({"cursor":"pointer"});
				modalBG.bind('click.modalEvent', function () {
					modal.trigger('wdpopup:close')
				});
			}
			if (options.noClose!='Y') {
				jQuery('body').keyup(function(e) {
					if(e.which===27){modal.trigger('wdpopup:close');}
				});
			}
			function unlockModal() { 
				locked = false;
			}
			function lockModal() {
				locked = true;
			}
		});
	}
	jQuery.wdPopupCookie = function (key, value, options) {
		if (arguments.length > 1 && (value === null || typeof value !== "object")) {
			options = jQuery.extend({}, options);
			if (value === null) {
				options.expires = -1;
			}
			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setDate(t.getDate() + days);
			}
			return (document.cookie = [
				encodeURIComponent(key), '=',
				options.raw ? String(value) : encodeURIComponent(String(value)),
				options.expires ? '; expires=' + options.expires.toUTCString() : '',
				options.path ? '; path=' + options.path : '',
				options.domain ? '; domain=' + options.domain : '',
				options.secure ? '; secure' : ''
			].join(''));
		}
		options = value || {};
		var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
		return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
	};
}

WD_Popup_OnReady(function(){
	if(!window.jQuery) {
		 var script = document.createElement('script');
		 script.type = "text/javascript";
		 script.src = "/bitrix/js/webdebug.popup/jquery.1.8.3.min.js";
		 document.getElementsByTagName('head')[0].appendChild(script);
	}
	if ('jQuery' in window) {
		WD_Popups_Init();
	} else {
		var t = setInterval(function() {
			if ('jQuery' in window) {
				WD_Popups_Init();
				clearInterval(t);
			}
		}, 50);
	}
});