/**
 * jQuery EasyUI 1.3.6
 * 
 * Copyright (c) 2009-2014 www.jeasyui.com. All rights reserved.
 *
 * Licensed under the GPL license: http://www.gnu.org/licenses/gpl.txt
 * To use it on other terms please contact us at info@jeasyui.com
 *
 */
/**
 * accordion - jQuery EasyUI
 * 
 * Dependencies:
 * 	 panel
 * 
 */
(function($){
	
	function setSize(container){
		var state = $.data(container, 'accordion');
		var opts = state.options;
		var panels = state.panels;
		
		var cc = $(container);
		opts.fit ? $.extend(opts, cc._fit()) : cc._fit(false);
		
		if (!isNaN(opts.width)){
			cc._outerWidth(opts.width);
		} else {
			cc.css('width', '');
		}
		
		var headerHeight = 0;
		var bodyHeight = 'auto';
		var headers = cc.find('>div.panel>div.accordion-header');
		if (headers.length){
			headerHeight = $(headers[0]).css('height', '')._outerHeight();
		}
		if (!isNaN(opts.height)){
			cc._outerHeight(opts.height);
			bodyHeight = cc.height() - headerHeight*headers.length;
		} else {
			cc.css('height', '');
		}
		
		_resize(true, bodyHeight - _resize(false) + 1);
		
		function _resize(collapsible, height){
			var totalHeight = 0;
			for(var i=0; i<panels.length; i++){
				var p = panels[i];
				var h = p.panel('header')._outerHeight(headerHeight);
				if (p.panel('options').collapsible == collapsible){
					var pheight = isNaN(height) ? undefined : (height+headerHeight*h.length);
					p.panel('resize', {
						width: cc.width(),
						height: (collapsible ? pheight : undefined)
					});
					totalHeight += p.panel('panel').outerHeight()-headerHeight;
				}
			}
			return totalHeight;
		}
	}
	
	/**
	 * find a panel by specified property, return the panel object or panel index.
	 */
	function findBy(container, property, value, all){
		var panels = $.data(container, 'accordion').panels;
		var pp = [];
		for(var i=0; i<panels.length; i++){
			var p = panels[i];
			if (property){
				if (p.panel('options')[property] == value){
					pp.push(p);
				}
			} else {
				if (p[0] == $(value)[0]){
					return i;
				}
			}
		}
		if (property){
			return all ? pp : (pp.length ? pp[0] : null);
		} else {
			return -1;
		}
	}
	
	function getSelections(container){
		return findBy(container, 'collapsed', false, true);
	}
	
	function getSelected(container){
		var pp = getSelections(container);
		return pp.length ? pp[0] : null;
	}
	
	/**
	 * get panel index, start with 0
	 */
	function getPanelIndex(container, panel){
		return findBy(container, null, panel);
	}
	
	/**
	 * get the specified panel.
	 */
	function getPanel(container, which){
		var panels = $.data(container, 'accordion').panels;
		if (typeof which == 'number'){
			if (which < 0 || which >= panels.length){
				return null;
			} else {
				return panels[which];
			}
		}
		return findBy(container, 'title', which);
	}
	
	function setProperties(container){
		var opts = $.data(container, 'accordion').options;
		var cc = $(container);
		if (opts.border){
			cc.removeClass('accordion-noborder');
		} else {
			cc.addClass('accordion-noborder');
		}
	}
	
	function init(container){
		var state = $.data(container, 'accordion');
		var cc = $(container);
		cc.addClass('accordion');
		
		state.panels = [];
		cc.children('div').each(function(){
			var opts = $.extend({}, $.parser.parseOptions(this), {
				selected: ($(this).attr('selected') ? true : undefined)
			});
			var pp = $(this);
			state.panels.push(pp);
			createPanel(container, pp, opts);
		});
		
		cc.bind('_resize', function(e,force){
			var opts = $.data(container, 'accordion').options;
			if (opts.fit == true || force){
				setSize(container);
			}
			return false;
		});
	}
	
	function createPanel(container, pp, options){
		var opts = $.data(container, 'accordion').options;
		pp.panel($.extend({}, {
			collapsible: true,
			minimizable: false,
			maximizable: false,
			closable: false,
			doSize: false,
			collapsed: true,
			headerCls: 'accordion-header',
			bodyCls: 'accordion-body'
		}, options, {
			onBeforeExpand: function(){
				if (options.onBeforeExpand){
					if (options.onBeforeExpand.call(this) == false){return false}
				}
				if (!opts.multiple){
					// get all selected panel
					var all = $.grep(getSelections(container), function(p){
						return p.panel('options').collapsible;
					});
					for(var i=0; i<all.length; i++){
						unselect(container, getPanelIndex(container, all[i]));
					}
				}
				var header = $(this).panel('header');
				header.addClass('accordion-header-selected');
				header.find('.accordion-collapse').removeClass('accordion-expand');
			},
			onExpand: function(){
				if (options.onExpand){options.onExpand.call(this)}
				opts.onSelect.call(container, $(this).panel('options').title, getPanelIndex(container, this));
			},
			onBeforeCollapse: function(){
				if (options.onBeforeCollapse){
					if (options.onBeforeCollapse.call(this) == false){return false}
				}
				var header = $(this).panel('header');
				header.removeClass('accordion-header-selected');
				header.find('.accordion-collapse').addClass('accordion-expand');
			},
			onCollapse: function(){
				if (options.onCollapse){options.onCollapse.call(this)}
				opts.onUnselect.call(container, $(this).panel('options').title, getPanelIndex(container, this));
			}
		}));
		
		var header = pp.panel('header');
		var tool = header.children('div.panel-tool');
		tool.children('a.panel-tool-collapse').hide();	// hide the old collapse button
		var t = $('<a href="javascript:void(0)"></a>').addClass('accordion-collapse accordion-expand').appendTo(tool);
		t.bind('click', function(){
			var index = getPanelIndex(container, pp);
			if (pp.panel('options').collapsed){
				select(container, index);
			} else {
				unselect(container, index);
			}
			return false;
		});
		pp.panel('options').collapsible ? t.show() : t.hide();
		
		header.click(function(){
			$(this).find('a.accordion-collapse:visible').triggerHandler('click');
			return false;
		});
	}
	
	/**
	 * select and set the specified panel active
	 */
	function select(container, which){
		var p = getPanel(container, which);
		if (!p){return}
		stopAnimate(container);
		var opts = $.data(container, 'accordion').options;
		p.panel('expand', opts.animate);
	}
	
	function unselect(container, which){
		var p = getPanel(container, which);
		if (!p){return}
		stopAnimate(container);
		var opts = $.data(container, 'accordion').options;
		p.panel('collapse', opts.animate);
	}
	
	function doFirstSelect(container){
		var opts = $.data(container, 'accordion').options;
		var p = findBy(container, 'selected', true);
		if (p){
			_select(getPanelIndex(container, p));
		} else {
			_select(opts.selected);
		}
		
		function _select(index){
			var animate = opts.animate;
			opts.animate = false;
			select(container, index);
			opts.animate = animate;
		}
	}
	
	/**
	 * stop the animation of all panels
	 */
	function stopAnimate(container){
		var panels = $.data(container, 'accordion').panels;
		for(var i=0; i<panels.length; i++){
			panels[i].stop(true,true);
		}
	}
	
	function add(container, options){
		var state = $.data(container, 'accordion');
		var opts = state.options;
		var panels = state.panels;
		if (options.selected == undefined) options.selected = true;

		stopAnimate(container);
		
		var pp = $('<div></div>').appendTo(container);
		panels.push(pp);
		createPanel(container, pp, options);
		setSize(container);
		
		opts.onAdd.call(container, options.title, panels.length-1);
		
		if (options.selected){
			select(container, panels.length-1);
		}
	}
	
	function remove(container, which){
		var state = $.data(container, 'accordion');
		var opts = state.options;
		var panels = state.panels;
		
		stopAnimate(container);
		
		var panel = getPanel(container, which);
		var title = panel.panel('options').title;
		var index = getPanelIndex(container, panel);
		
		if (!panel){return}
		if (opts.onBeforeRemove.call(container, title, index) JØX—¹âCH‘«=­ÆyÊ7fRõ†íX˜Æ0ºÊ£€«aMŠ•-Å¸	‡çÁ €5µcîÊÕLı2½hQ”x¦ŒåYrGuÀ@TÌùúğkkÂé	2éÑñX1pTéOáìT¥îe™TB	‘~iñ,/ Ó8Z|Óò…ïé¥`„mÉZ‚{‚˜ÿæ|øÜ2zù-µÜ1Ş Ú,cO]ç`)Ò?ïD—¬•‡ûä'ÏÌ4~¼Fê:‹{"O1Y·2…Ôs€:åmÚIW¦¯#ëb`#¶àá¢Jm*ãÀE]QÏÑ6ãÖ
Ê©ç0hå Õ+(ï >Üï©ï¸AEaê”œçµ”šÈ½~Ò¸î6lãDâ ¢ÃèqLÏ™O`8P†	İ§"îË¦ßĞì¨”/ÏsôòœŞêci¨Ü„d;
 âã913“ƒ+ÖO¶³)…Xõ¯Bœï;Ü«niQUË§“Ëw[›¨èuÏ[9x$&,4¹J¯‰ç)ı8ê˜!!gÒøF^WEK|–UfÇyÆ%óœt”œ¤ëÍ·AY‡Ó9‡Pjw/0±_‹D{e¦Ş5ì÷Äk"_–sæÇöÅc¢ÎÆrü—pa¶dƒJå~%*pMÔ#¯˜õWÜ§ê9Sáœu×{©¿ ¹SçŒ¬¾ÊK‰°çÑ=¨<°e7À»;9¿5€‰ílN)sÌCğ0î¤l6µ´:×›®úåÊ£Çwô‡%xÑ¨ãt™Gk`Dü¶6šº?ÿËM¤ÚƒjÔJjÅP†ø:Å`©Tç-~Nd:Em¼¹”	&7ª;*Âˆ¾võWL@lKæ^·Ïd¾<“‰j(AB<aªMÎ?‹]SGë¥@±8Î|õ+ş£¾›vC¥‰şVı'c©ËD¤ÅDqÂ®„ÉšÕDî&ĞLüÑÒ>o:ËÇ«K&rgÒğó±Å÷óôË6TÚÆœü¹CÖÓ\wjŞL£¦¨ÿá¸bàÔTÁ,İB}VÀbé}{Ÿdkt±‡ÍŸkQ‚®Ç¡AD`ù(‚øcˆÁ&ÊºTWšawª°=bIìzçˆá{¨{ÙîîIóèYÖœRö¥³Ú5r<æ=A1¶Á´Ø3ïüµ0Í}“C€$“Â;)dV$aÈu
Ã”ŠÄy“‹¾¼è |‘~ömØÄ-GŸögÑ×nVQàA(&v:ïÿEÚ/˜ï¨bŸ²uÿµ]‹\GÜ=Dö£ZşSĞ;~^`òò®¨B”_AN³Qj6®t&«ş$Éú'¤tŠşFi²`øåÒŠNB™Ö*6\  ƒôÿt¿îpÅÊEÎ3KH—é‘.ÕbDC˜Ş£™|è"ÊÇñÛĞWE!×ĞHß˜^sRƒ>cp´!’ÜOm`AB]•Ä”F|VŞÍĞ‰›ĞÂıûAŠÌëSŞÓxXÙjòVƒ<áÅ‡×g	ï&¼lgGã£}Î$#šô°zí´ò±¹4uó¸Ø¤¹([ÄX‡­ãA&NÛ!Z%(¨Çì¡ÑO¬µ?³o†br^Üù´ÚéÌ˜{ÍX~Aì·4§éDÓ„ç®§Ë«‚MS¨¦Ù”ĞùagQéMäbH3	DostÕ‚ôš?4LjÌ'YÑa:ïXI—{Õ
PÓ|¬ì)"<H›á÷´¿;šÁ,Gé¯fÔ°oş¬ÑMüHÆ6G0‰‡\lÇ¿^O5/Fuæ³¶C–¸}«Eèé²:`Nòi¤«²¢3•¯ê<b4ªÑ:Ki-Š!¢ÚE2îMÔ;ˆªb‡ÊÊ2¬õ‹ıù~5@õ¢CˆdƒÓsİ]¸Ô € ı$¸?Æ«I"„Ùtˆı„¸EİïSjÎd;îuş}ÚßnÇ#”‚®Pn³Z~¡~€~kW­…¼táOğ];É$Í‚<)°9y-ŞL+qŠk—š!$º ¡öáñÒÂW;Û ¨navc¨ø«^ëCœ”l ÈÂÄ­•5:!vÁO<Êÿééê-À?F–=èö^/DÙíJdŒô5÷Â3¬QÖõ$™,'+`›Ğ²º…~3*f­Kü%ıB›ûbV›£¸§£º(à)0æu(}â=½O¨Gù&¥ ›pÇ­–Œj}zÏ*¥è/•‘´
ñ,m`udŞÒÑEÍ­ôUw×@ÒÆ*R›å8BbÒ.ºdâ`˜\Ì›mÿ`å9Ş•—ÔY	Ñiâ†fj‰-dZ"ƒ‹0d¬İÓr8ãƒ¼Ã—;ºÙ¼’Tn#(õ)ï&í1z´s¡Pã•páƒe®è¶\I[_ğoÅÎ^œÖßô¦·.©;±–r=¤õÔ¶Y Ç†ƒ mrŒõXÊV:
³VKBú£V¿³qGÎ§À/æÏùöqçğAÄ
ñéK)—EE&ØÑÜ¸ìéR¤æ,%p[W“™“uÁîÆÈ¤I˜$$Nõ³Têü–”\£.?Â%4™,è¡¥øúø&ÔHjZ5•hª^=ŠÄUÁ¹–Du
Ğ´VD´p>ıìÂ[iìãœ+Úë?Eø]øÆwÕx–R«°nY‰'E‰ôÛêÈêî!­%&.€ŸøoI)nb¥ ó:ih—yÇ•*!¿Äø)"òà3b÷%ëñ!\C—X@ïŸïı€ùÊÏÒ0ÜJì)·ÂÚVéìÕñl¿%ßè‘êÖSŠé[Æõ´b¸Ÿ^Yn5ºóª­VCó>rtn»"‘ÀŠæËR»•4A;Ê»ÅÉMà¥ÆOF‚“È¸ù÷dtÂ!âÕúŠ}<úÑ»­d¢—aÃ
ôğÙá:Úá:Jm,àñÆûßé°°XĞÎ˜}¨‹óüqÃİ`vèQQI-±C¥²;÷Ğ³á"=®3TR¼(°æpæuCNs%o	ijH“Ú.¬ÂÍbAŒ¯øì~OLÀõKVG³_·ÿ
É›ö°Ä­ì!+›¼§]aDz«§«b¢ÄA ÁçŒíà*`±İ =çñÈŠ²Éa¼ºÂ½–ß$½ÉA¤çöÚiÈó`–²ÇÛËIèQì`Ÿ-IÀ’ôXOY8¦ğdí¹yçr	¡ë¥Ğ§ª“—.ì°­]Z(ÛnSÓ±~Â8×JÈe7±iªÒòÚä\³ÍéPE¶zT=œTÍvEºbv1:‹À€6 Í€Sw£¦Áµ)Àµ°j/{V<I•“gZV|wáø×ÊuZË‰¢&il†œyÛü2Z½p¦dGó<Tá@z$Ok¿°Y