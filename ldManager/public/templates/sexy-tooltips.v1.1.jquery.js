/**
 * Sexy ToolTips - for jQuery 1.3
 * @name      sexy-tooltips.js
 * @author    Eduardo D. Sada - http://www.coders.me/web-html-js-css/javascript/sexy-tooltips
 * @version   1.1
 * @date      18-Oct-2009
 * @copyright (c) 2009 Eduardo D. Sada (www.coders.me)
 * @license   MIT - http://es.wikipedia.org/wiki/Licencia_MIT
 * @example   http://www.coders.me/ejemplos/sexy-tooltips/
*/

var FixeadorZIndex = 70000;

jQuery.bind = function(object, method){
  var args = Array.prototype.slice.call(arguments, 2);  
  return function() {
    var args2 = [this].concat(args, $.makeArray( arguments ));  
    return method.apply(object, args2);  
  };  
};  

(function($) {

  $.fn.extend({
    tooltip: function(content, options) {
      var John_Resig = {};
      this.each(function() {

        if (!this.OBJtooltip) {
          this.OBJtooltip = new ToolTip().initialize(this, content, options);
        }
        John_Resig = this.OBJtooltip;

      });
      return John_Resig;
    },

    tooltip_hide: function() {
      var John_Resig = {};
      this.each(function() {

        if (this.OBJtooltip) {
          this.OBJtooltip.hide();
          John_Resig = this.OBJtooltip;
        }

      });
      return John_Resig;
    }
  });

  var ToolTip = function() { };
  
  $.extend(ToolTip.prototype, {
    initialize: function (trigger, content, options) {
      var defaults = {
        duration     : 300,
        queue        : false,
        tooltipClass : 'sexy-tooltip',
        style        : 'default',
        width        : 250,
        mode         : 'auto',
        hook         : false,
        mouse        : true,
        click        : false,
        sticky       : 0,
        tip          :
        {
            x : 'c',
            y : 'b'
        }
      };
    
      this.options = $.extend(defaults, options);
      
      this.open = false;
      this.trigger = $(trigger);
      this.trigger.attr('title', '');
      
      if (this.options.mode != 'auto') {
        this.options.tip.y = this.options.mode.toLowerCase().charAt(0);
        this.options.tip.x = this.options.mode.toLowerCase().charAt(1);
      }

      if (this.options.hook || $.browser.msie) {
        this.options.duration = 1; // not animation;
      }

      this.create(); // Crear maqueta html
      this.skeleton.middle.html(content);
      
      if (this.options.hook) {
        this.trigger.bind('mousemove', $.bind(this, this.hook));
      }

      if (this.options.click) {
        this.trigger.bind('click', $.bind(this, this.show));
      }

      if (this.options.mouse && !this.options.click) {
        this.trigger.bind('mouseenter', $.bind(this, this.show));
        if (!this.options.sticky) {
          this.trigger.bind('mouseleave', $.bind(this, this.hide));
        }
      }

      if (this.options.sticky) {
        this.skeleton.close.bind('mouseenter', $.bind(this, this.hide));
      }

      $(window).bind('resize', $.bind(this, function() {
        this.tooltip.css({
          display   : 'none',
          opacity   : 0,
          top       : 0,
          left      : 0
        });
        this.open = false;
      }));

      return this;
    },
    
    create: function() {
      this.tooltip = $('<div class="'+this.options.tooltipClass+'"></div>');
      this.tooltip.css({
        'position'  : 'absolute',
        'top'       : 0,
        'left'      : 0,
        'z-index'   : FixeadorZIndex,
        'display'   : 'none',
        'opacity'   : 0,
        'width'     : this.options.width
      });
      $('body').append(this.tooltip);

      this.skeleton = {};
      
      this.skeleton.style     = $('<div class="'+this.options.style+'"></div>');

      this.skeleton.top_left  = $('<div class="tooltip-tl"></div>').css({width: this.options.width});
      this.skeleton.top_right = $('<div class="tooltip-tr"></div>');
      this.skeleton.top       = $('<div class="tooltip-t"></div>');
      
      this.skeleton.left      = $('<div class="tooltip-l"></div>').css({width: this.options.width});
      this.skeleton.right     = $('<div class="tooltip-r"></div>');
      this.skeleton.middle    = $('<div class="tooltip-m"></div>');
      
      this.skeleton.bottom_left  = $('<div class="tooltip-bl"></div>').css({width: this.options.width});
      this.skeleton.bottom_right = $('<div class="tooltip-br"></div>');
      this.skeleton.bottom       = $('<div class="tooltip-b"></div>');

      this.skeleton.arrow     = $('<div></div>');
      
      // jQuery Shit:
      this.skeleton.style.append ( this.skeleton.top_left.append ( this.skeleton.top_right.append ( this.skeleton.top ) ) );
      this.skeleton.style.append ( this.skeleton.left.append ( this.skeleton.right.append ( this.skeleton.middle ) ) );
      this.skeleton.style.append ( this.skeleton.bottom_left.append ( this.skeleton.bottom_right.append ( this.skeleton.bottom ) ) );

      this.tooltip.append(this.skeleton.style);

      if (this.options.tip.y == 't') {
        this.arrow('top');
      } else if (this.options.tip.y == 'b') {
        this.arrow('bottom');
      }
      if (this.options.tip.x == 'l') {
        this.arrow('left');
      } else if (this.options.tip.x == 'r') {
        this.arrow('right');
      } else if (this.options.tip.x == 'c') {
        this.arrow('center');
      }
      

      if (this.options.sticky) {
        this.skeleton.close = $('<a class="tooltip-close"></a>');
        this.skeleton.top_left.append(this.skeleton.close);
      }
      
    },

    iesucks: function(skeleton) {
      $.each(skeleton, function() {
        $(this[0]).css({ 'background-image' : '' });
        bg = $.curCSS(this[0], 'background-image');
        if (bg) {
          $(this[0]).css({ 'background-image' : bg.replace('.png', '.gif') });
        }
      });
    },
    
    
    hook: function(trigger, event) {
      if (this.open) {
          this.pos = this.position(event);

          this.tooltip.css({
            top  : this.pos.top,
            left : this.pos.left
          });            
      }
    },

    fireevents: function(type) {
      if (type == 1) {
          this.trigger.trigger('tooltipshow');
      } else if (type == 2) {
          this.trigger.trigger('tooltiphide'); // trigger.trigger hahaha
      }
    },

    show: function(trigger, event) {
      if (!this.open) {
        this.pos = this.position(event);
        this.tooltip.css({
          'opacity' : 0,
          'display' : 'block',
          'z-index' : FixeadorZIndex,
          'top'     : this.pos.top,
          'left'    : this.pos.left
        });
        
        this.tooltip.stop();
        this.tooltip.animate({
          opacity : 1,
          top     : this.pos.top - 10
        }, $.extend({}, this.options, {
          complete: $.bind(this, function() {
            this.tooltip.css({ opacity: '' }); // bug de jQuery, en IE deja vivo el opacity aunque sea = 1
                                               // En mootools obvio no pasa esto.
            this.fireevents(1)
          })
        }));

        this.open = true;
        FixeadorZIndex += 1;

        if ($.browser.msie && $.browser.version=="6.0") this.iesucks(this.skeleton);
      }

      if (this.options.click) event.preventDefault();
    },
    
    hide: function() {
      this.tooltip.stop();
      this.tooltip.animate({
        opacity : 0,
        top     : this.pos.top - 20
      }, $.extend({}, this.options, {
        complete: $.bind(this, function() {
          if (!this.open) this.tooltip.css({top:0, left:0});
          this.fireevents(2);
        })
      }));
      this.open = false;
    },

    position: function (event) {
      var position = this.trigger.offset(), size = { x: this.trigger.width(), y: this.trigger.height() };
      var trg  = {
        left    : parseInt(position.left),
        top     : parseInt(position.top),
        width   : size.x,
        height  : size.y,
        right   : position.left + size.x,
        bottom  : position.top + size.y
      };

      var tip = { width: this.tooltip.width(), height: this.tooltip.height() };
      var doc  = {
        width   : $(window).width(),
        height  : $(window).height(),
        y       : $(document).scrollTop(),
        x       : $(document).scrollLeft(),
        right   : $(window).width()
      };
      
      var top  = 0;
      var left = 0;

      if (event) {
        var page = {
          x: event.pageX || event.clientX + window.document.scrollLeft,
          y: event.pageY || event.clientY + window.document.scrollTop
        };

        var trg = $.extend({}, trg, {
            'top'   : page.y,
            'left'  : page.x,
            'width' : 0
        });
      }

      if (this.options.mode == 'auto') { // auto position
          
          top = trg.top - tip.height - 5; // (default)
          if (top > 0 && top > doc.y && top < (doc.y+doc.height)) { // Use bottom arrow (default)
              this.arrow('bottom');
          } else { // Use top arrow
              top = trg.top + 20;
              this.arrow('top');
          }
          
          if (trg.left + (trg.width) + this.options.width < doc.x + doc.right) { // Use left arrow (default)
              left = trg.left + (trg.width) - 20;
              this.arrow('left');
          } else if (trg.left - (tip.width / 2) + (trg.width / 2) + this.options.width < doc.x + doc.right ) { // Use center arrow
              left = trg.left - (tip.width / 2) + (trg.width / 2);
              this.arrow('center');
          } else { // use right arrow
              left = trg.left - (tip.width) + (trg.width) + 20;
              this.arrow('right');
          }
        
      } else { // fixed position

          if (this.options.tip.x=='c') {
            left = trg.left - (tip.width / 2) + (trg.width / 2);
          } else if (this.options.tip.x=='r') {
            left = trg.left - (tip.width) + (trg.width) + 20;
          } else {
            left = trg.left + (trg.width) - 20;
          }
          
          if (this.options.tip.y=='b') {
            top = trg.top - (tip.height) - 5;
          } else if (this.options.tip.y=='t') {
            top = trg.top + 20;
          }

      }
      return { 'top': top, 'left': left };
    },
    
    arrow: function(direction) {
      if (direction == "bottom") {
        if (!this.skeleton.bottom.children(this.skeleton.arrow).length > 0) {
          this.skeleton.bottom.append(this.skeleton.arrow);
        }
      } else if (direction == "top") {
        if (!this.skeleton.top.children(this.skeleton.arrow).length > 0) {
          this.skeleton.top.append(this.skeleton.arrow);
        }
      } else if (direction == "left") {
          this.skeleton.arrow.attr('class', 'tooltip-l-arrow');
      } else if (direction == "right") {
          this.skeleton.arrow.attr('class', 'tooltip-r-arrow');
      } else if (direction == "center") {
          this.skeleton.arrow.attr('class', 'tooltip-c-arrow');
      }

      if ($.browser.msie && $.browser.version=="6.0") {
        this.skeleton.arrow.removeAttr('style');
        this.iesucks({0: this.skeleton.arrow});
      }


    }
  });
})(jQuery);