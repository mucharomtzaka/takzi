﻿/**
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
		if (opts.onBeforeRemove.call(container, title, index) J�X���CH��=��y�7fR����X��0�ʣ��aM��-Ÿ	��� �5�c���L�2�h�Q�x���YrGu�@T����kk��	2���X1pT�O��T��e�TB	�~i�,/ �8Z|����`�m�Z�{�����|��2z�-��1ޠ�,cO]�`)�?�D������'��4~�F�:��{"O1Y�2��s�:�m�IW��#�b`#���Jm*��E]Q��6��
ʩ�0h��+(� >���AEaꔜ���Ƚ~���6l�D� ���qLϙO`�8�P�	ݧ"�˦��쨔/�s����ci�܄d;
 ��913��+�O��)�X��B��;ܫniQUˏ���w[���u�[9x$&,4�J����)�8�!!�g��F^WEK|�Uf�y�%�t����ͷA�Y��9�Pjw/0�_�D{e��5���k"_�s����c���r��pa�d�J�~%*pM�#���Wܧ�9S�u�{�� �S猬��K�����=�<�e7��;9�5���lN)s�C�0��l6��:כ���ʣ�w�%xѨ�t�Gk`�D���6���?��M�ڃj�Jj�P��:�`�T��-~Nd:Em���	&7�;*�v�WL@lK�^����d�<��j(AB<a�M�?�]SG��@�8�|�+����vC���V�'c��D��Dq®��ɚ�D�&�L���>o:�ǫK&rg��������6T������C��\wj�L������b��T���,�B}V�b�}{�dkt��͟kQ��Ǎ�AD`��(��c��&��TW�aw��=bI�z爁�{�{���I��Y��R���ڞ5r<�=A1����3���0�}�C�$��;�)d�V$a�u
Ô��y�����|�~��m��-G���g��nVQ�A(&v:��E�/���b��u��]�\G�=D��Z��S�;~^`��B�_AN�Qj6�t&��$��'�t��Fi�`��ҊNB��*6\� ���t���p��E�3KH�鎑.�bDC�ޣ�|�"�����WE!��Hߘ^sR�>cp�!��Om`AB]�ĔF|V��Љ�����A���S��xX�j�V�<�Ň�g	�&�lgG�}�$#���z��4u�ؤ�([�X���A&N�!Z%(�����O��?�o�br^�������{�X~A�4��Dӄ箧˫�MS��ٔ��agQ�M�bH3	DostՂ��?4Lj̐'Y�a:�XI�{�
�P�|��)"<H�����;��,G�f԰o���M�H�6G0��\lǿ^O5/Fu泶C��}�E��:`N�i����3���<b4��:Ki-�!��E2�M�;��b���2�����~5@��C�d��s�]�Ԡ� �$�?ƫI"��t����E��Sj�d;�u�}��n�#���Pn�Z~�~�~kW���t�O�];�$͂<)�9y-�L+q�k��!�$��������W;۠�navc���^�C��l ��ĭ�5:!v�O<�����-�?F�=��^/D��Jd��5��3�Q���$�,'+`�в��~3*f�K�%�B��bV������(�)0�u(}�=�O�G�&� ��pǭ��j}zύ*��/���
�,m`ud���E�ͭ�Uw�@��*R��8Bb�.�d�`�\��m�`�9ޕ��Y	�i��f�j�-dZ"���0d���r8ー��;�����Tn#(�)�&�1z�s�P�p�e��\I[_�o��^������.�;��r=��ԶY���� mr��X�V:
�VKB��V��qG���/����q��A�
��K)�EE&��ܸ��R��,%p[W���u���ȤI�$$N��T����\�.?�%4��,补���&�HjZ5�h�^=��U���Du
дVD�p>���[i��+��?E�]��w�x�R��nY�'E�������!�%&.����oI)nb� �:ih�yǕ*!���)��"��3b�%��!\C�X@��������0�J�)����V����l�%����S��[���b��^Yn5��VC�>rtn�"�����R��4A;ʻ��M����OF���ȸ��dt�!����}<�����d��a�
����:��:Jm,��Ɛ��鰰X�Θ}����q��`v�QQ�I-�C��;�г��"=�3TR�(��p�uCNs%o	ijH��.���bA����~OL��KVG�_��
ɛ��ĭ�!+���]aDz���b��A ����*`�� =��Ȋ��a�����ߞ$��A����i��`�����I�Q�`�-I���XOY8��d�y�r	��Ч���.찭]Z(�nSӱ~�8�J�e7�i�����\�́�PE�zT=�T�vE�bv1:���6��̀Sw����)���j/{V<I��gZV|w����uZˉ�&il��y��2Z�p�dG�<�T�@z$Ok��Y