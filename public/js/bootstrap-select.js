!function(e){"use strict";e.expr[":"].icontains=function(t,i,s){return e(t).text().toUpperCase().indexOf(s[3].toUpperCase())>=0};var t=function(i,s,n){n&&(n.stopPropagation(),n.preventDefault()),this.$element=e(i),this.$newElement=null,this.$button=null,this.$menu=null,this.$lis=null,this.options=s,null===this.options.title&&(this.options.title=this.$element.attr("title")),this.val=t.prototype.val,this.render=t.prototype.render,this.refresh=t.prototype.refresh,this.setStyle=t.prototype.setStyle,this.selectAll=t.prototype.selectAll,this.deselectAll=t.prototype.deselectAll,this.destroy=t.prototype.destroy,this.show=t.prototype.show,this.hide=t.prototype.hide,this.init()};t.VERSION="1.5.4",t.prototype={constructor:t,init:function(){var t=this,i=this.$element.attr("id");this.$element.hide(),this.multiple=this.$element.prop("multiple"),this.autofocus=this.$element.prop("autofocus"),this.$newElement=this.createView(),this.$element.after(this.$newElement),this.$menu=this.$newElement.find("> .dropdown-menu"),this.$button=this.$newElement.find("> button"),this.$searchbox=this.$newElement.find("input"),void 0!==i&&(this.$button.attr("data-id",i),e('label[for="'+i+'"]').click(function(e){e.preventDefault(),t.$button.focus()})),this.checkDisabled(),this.clickListener(),this.options.liveSearch&&this.liveSearchListener(),this.render(),this.liHeight(),this.setStyle(),this.setWidth(),this.options.container&&this.selectPosition(),this.$menu.data("this",this),this.$newElement.data("this",this),this.options.mobile&&this.mobile()},createDropdown:function(){var t=this.multiple?" show-tick":"",i=this.$element.parent().hasClass("input-group")?" input-group-btn":"",s=this.autofocus?" autofocus":"",n=this.options.header?'<div class="popover-title"><button type="button" class="close" aria-hidden="true">&times;</button>'+this.options.header+"</div>":"",o=this.options.liveSearch?'<div class="bootstrap-select-searchbox"><input type="text" class="input-block-level form-control" autocomplete="off" /></div>':"",a=this.options.actionsBox?'<div class="bs-actionsbox"><div class="btn-group btn-block"><button class="actions-btn bs-select-all btn btn-sm btn-default">Select All</button><button class="actions-btn bs-deselect-all btn btn-sm btn-default">Deselect All</button></div></div>':"";return e('<div class="btn-group bootstrap-select'+t+i+'"><button type="button" class="btn dropdown-toggle selectpicker" data-toggle="dropdown"'+s+'><span class="filter-option pull-left"></span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open">'+n+o+a+'<ul class="dropdown-menu inner selectpicker" role="menu"></ul></div></div>')},createView:function(){var e=this.createDropdown(),t=this.createLi();return e.find("ul").append(t),e},reloadLi:function(){this.destroyLi();var e=this.createLi();this.$menu.find("ul").append(e)},destroyLi:function(){this.$menu.find("li").remove()},createLi:function(){var t=this,i=[],s="",n=0;return this.$element.find("option").each(function(){var s=e(this),o=s.attr("class")||"",a=s.attr("style")||"",l=s.data("content")?s.data("content"):s.html(),d=void 0!==s.data("subtext")?'<small class="muted text-muted">'+s.data("subtext")+"</small>":"",r=void 0!==s.data("icon")?'<i class="'+t.options.iconBase+" "+s.data("icon")+'"></i> ':"";if(""!==r&&(s.is(":disabled")||s.parent().is(":disabled"))&&(r="<span>"+r+"</span>"),s.data("content")||(l=r+'<span class="text">'+l+d+"</span>"),t.options.hideDisabled&&(s.is(":disabled")||s.parent().is(":disabled")))i.push('<a style="min-height: 0; padding: 0"></a>');else if(s.parent().is("optgroup")&&!0!==s.data("divider"))if(0===s.index()){var h=s.parent().attr("label"),c=void 0!==s.parent().data("subtext")?'<small class="muted text-muted">'+s.parent().data("subtext")+"</small>":"",p=s.parent().data("icon")?'<i class="'+t.options.iconBase+" "+s.parent().data("icon")+'"></i> ':"";h=p+'<span class="text">'+h+c+"</span>",n+=1,0!==s[0].index?i.push('<div class="div-contain"><div class="divider"></div></div><dt>'+h+"</dt>"+t.createA(l,"opt "+o,a,n)):i.push("<dt>"+h+"</dt>"+t.createA(l,"opt "+o,a,n))}else i.push(t.createA(l,"opt "+o,a,n));else!0===s.data("divider")?i.push('<div class="div-contain"><div class="divider"></div></div>'):!0===e(this).data("hidden")?i.push("<a></a>"):i.push(t.createA(l,o,a))}),e.each(i,function(e,t){s+='<li rel="'+e+'"'+("<a></a>"===t?'class="hide is-hidden"':"")+">"+t+"</li>"}),this.multiple||0!==this.$element.find("option:selected").length||this.options.title||this.$element.find("option").eq(0).prop("selected",!0).attr("selected","selected"),e(s)},createA:function(e,t,i,s){return'<a tabindex="0" class="'+t+'" style="'+i+'"'+(void 0!==s?'data-optgroup="'+s+'"':"")+">"+e+'<i class="'+this.options.iconBase+" "+this.options.tickIcon+' icon-ok check-mark"></i></a>'},render:function(t){var i=this;!1!==t&&this.$element.find("option").each(function(t){i.setDisabled(t,e(this).is(":disabled")||e(this).parent().is(":disabled")),i.setSelected(t,e(this).is(":selected"))}),this.tabIndex();var s=this.$element.find("option:selected").map(function(){var t,s=e(this),n=s.data("icon")&&i.options.showIcon?'<i class="'+i.options.iconBase+" "+s.data("icon")+'"></i> ':"";return t=i.options.showSubtext&&s.attr("data-subtext")&&!i.multiple?' <small class="muted text-muted">'+s.data("subtext")+"</small>":"",s.data("content")&&i.options.showContent?s.data("content"):void 0!==s.attr("title")?s.attr("title"):n+s.html()+t}).toArray(),n=this.multiple?s.join(this.options.multipleSeparator):s[0];if(this.multiple&&this.options.selectedTextFormat.indexOf("count")>-1){var o=this.options.selectedTextFormat.split(">"),a=this.options.hideDisabled?":not([disabled])":"";(o.length>1&&s.length>o[1]||1==o.length&&s.length>=2)&&(n=this.options.countSelectedText.replace("{0}",s.length).replace("{1}",this.$element.find('option:not([data-divider="true"], [data-hidden="true"])'+a).length))}this.options.title=this.$element.attr("title"),"static"==this.options.selectedTextFormat&&(n=this.options.title),n||(n=void 0!==this.options.title?this.options.title:this.options.noneSelectedText),this.$button.attr("title",e.trim(e("<div/>").html(n).text()).replace(/\s\s+/g," ")),this.$newElement.find(".filter-option").html(n)},setStyle:function(e,t){this.$element.attr("class")&&this.$newElement.addClass(this.$element.attr("class").replace(/selectpicker|mobile-device|validate\[.*\]/gi,""));var i=e||this.options.style;"add"==t?this.$button.addClass(i):"remove"==t?this.$button.removeClass(i):(this.$button.removeClass(this.options.style),this.$button.addClass(i))},liHeight:function(){if(!1!==this.options.size){var e=this.$menu.parent().clone().find("> .dropdown-toggle").prop("autofocus",!1).end().appendTo("body"),t=e.addClass("open").find("> .dropdown-menu"),i=t.find("li > a").outerHeight(),s=this.options.header?t.find(".popover-title").outerHeight():0,n=this.options.liveSearch?t.find(".bootstrap-select-searchbox").outerHeight():0,o=this.options.actionsBox?t.find(".bs-actionsbox").outerHeight():0;e.remove(),this.$newElement.data("liHeight",i).data("headerHeight",s).data("searchHeight",n).data("actionsHeight",o)}},setSize:function(){var t,i,s,n=this,o=this.$menu,a=o.find(".inner"),l=this.$newElement.outerHeight(),d=this.$newElement.data("liHeight"),r=this.$newElement.data("headerHeight"),h=this.$newElement.data("searchHeight"),c=this.$newElement.data("actionsHeight"),p=o.find("li .divider").outerHeight(!0),u=parseInt(o.css("padding-top"))+parseInt(o.css("padding-bottom"))+parseInt(o.css("border-top-width"))+parseInt(o.css("border-bottom-width")),m=this.options.hideDisabled?":not(.disabled)":"",f=e(window),v=u+parseInt(o.css("margin-top"))+parseInt(o.css("margin-bottom"))+2,b=function(){i=n.$newElement.offset().top-f.scrollTop(),s=f.height()-i-l};if(b(),this.options.header&&o.css("padding-top",0),"auto"==this.options.size){var $=function(){var e,l=n.$lis.not(".hide");b(),t=s-v,n.options.dropupAuto&&n.$newElement.toggleClass("dropup",i>s&&t-v<o.height()),n.$newElement.hasClass("dropup")&&(t=i-v),e=l.length+l.find("dt").length>3?3*d+v-2:0,o.css({"max-height":t+"px",overflow:"hidden","min-height":e+r+h+c+"px"}),a.css({"max-height":t-r-h-c-u+"px","overflow-y":"auto","min-height":Math.max(e-u,0)+"px"})};$(),this.$searchbox.off("input.getSize propertychange.getSize").on("input.getSize propertychange.getSize",$),e(window).off("resize.getSize").on("resize.getSize",$),e(window).off("scroll.getSize").on("scroll.getSize",$)}else if(this.options.size&&"auto"!=this.options.size&&o.find("li"+m).length>this.options.size){var g=o.find("li"+m+" > *").not(".div-contain").slice(0,this.options.size).last().parent().index(),x=o.find("li").slice(0,g+1).find(".div-contain").length;t=d*this.options.size+x*p+u,n.options.dropupAuto&&this.$newElement.toggleClass("dropup",i>s&&t<o.height()),o.css({"max-height":t+r+h+c+"px",overflow:"hidden"}),a.css({"max-height":t-u+"px","overflow-y":"auto"})}},setWidth:function(){if("auto"==this.options.width){this.$menu.css("min-width","0");var e=this.$newElement.clone().appendTo("body"),t=e.find("> .dropdown-menu").css("width"),i=e.css("width","auto").find("> button").css("width");e.remove(),this.$newElement.css("width",Math.max(parseInt(t),parseInt(i))+"px")}else"fit"==this.options.width?(this.$menu.css("min-width",""),this.$newElement.css("width","").addClass("fit-width")):this.options.width?(this.$menu.css("min-width",""),this.$newElement.css("width",this.options.width)):(this.$menu.css("min-width",""),this.$newElement.css("width",""));this.$newElement.hasClass("fit-width")&&"fit"!==this.options.width&&this.$newElement.removeClass("fit-width")},selectPosition:function(){var t,i,s=this,n=e("<div />"),o=function(e){n.addClass(e.attr("class").replace(/form-control/gi,"")).toggleClass("dropup",e.hasClass("dropup")),t=e.offset(),i=e.hasClass("dropup")?0:e[0].offsetHeight,n.css({top:t.top+i,left:t.left,width:e[0].offsetWidth,position:"absolute"})};this.$newElement.on("click",function(){s.isDisabled()||(o(e(this)),n.appendTo(s.options.container),n.toggleClass("open",!e(this).hasClass("open")),n.append(s.$menu))}),e(window).resize(function(){o(s.$newElement)}),e(window).on("scroll",function(){o(s.$newElement)}),e("html").on("click",function(t){e(t.target).closest(s.$newElement).length<1&&n.removeClass("open")})},mobile:function(){this.$element.addClass("mobile-device").appendTo(this.$newElement),this.options.container&&this.$menu.hide()},refresh:function(){this.$lis=null,this.reloadLi(),this.render(),this.setWidth(),this.setStyle(),this.checkDisabled(),this.liHeight()},update:function(){this.reloadLi(),this.setWidth(),this.setStyle(),this.checkDisabled(),this.liHeight()},setSelected:function(t,i){null==this.$lis&&(this.$lis=this.$menu.find("li")),e(this.$lis[t]).toggleClass("selected",i)},setDisabled:function(t,i){null==this.$lis&&(this.$lis=this.$menu.find("li")),i?e(this.$lis[t]).addClass("disabled").find("a").attr("href","#").attr("tabindex",-1):e(this.$lis[t]).removeClass("disabled").find("a").removeAttr("href").attr("tabindex",0)},isDisabled:function(){return this.$element.is(":disabled")},checkDisabled:function(){var e=this;this.isDisabled()?this.$button.addClass("disabled").attr("tabindex",-1):(this.$button.hasClass("disabled")&&this.$button.removeClass("disabled"),-1==this.$button.attr("tabindex")&&(this.$element.data("tabindex")||this.$button.removeAttr("tabindex"))),this.$button.click(function(){return!e.isDisabled()})},tabIndex:function(){this.$element.is("[tabindex]")&&(this.$element.data("tabindex",this.$element.attr("tabindex")),this.$button.attr("tabindex",this.$element.data("tabindex")))},clickListener:function(){var t=this;e("body").on("touchstart.dropdown",".dropdown-menu",function(e){e.stopPropagation()}),this.$newElement.on("click",function(){t.setSize(),t.options.liveSearch||t.multiple||setTimeout(function(){t.$menu.find(".selected a").focus()},10)}),this.$menu.on("click","li a",function(i){var s=e(this).parent().index(),n=t.$element.val(),o=t.$element.prop("selectedIndex");if(t.multiple&&i.stopPropagation(),i.preventDefault(),!t.isDisabled()&&!e(this).parent().hasClass("disabled")){var a=t.$element.find("option"),l=a.eq(s),d=l.prop("selected"),r=l.parent("optgroup"),h=t.options.maxOptions,c=r.data("maxOptions")||!1;if(t.multiple){if(l.prop("selected",!d),t.setSelected(s,!d),e(this).blur(),!1!==h||!1!==c){var p=h<a.filter(":selected").length,u=c<r.find("option:selected").length,m=t.options.maxOptionsText,f=m[0].replace("{n}",h),v=m[1].replace("{n}",c),b=e('<div class="notify"></div>');if(h&&p||c&&u)if(h&&1==h)a.prop("selected",!1),l.prop("selected",!0),t.$menu.find(".selected").removeClass("selected"),t.setSelected(s,!0);else if(c&&1==c){r.find("option:selected").prop("selected",!1),l.prop("selected",!0);var $=e(this).data("optgroup");t.$menu.find(".selected").has('a[data-optgroup="'+$+'"]').removeClass("selected"),t.setSelected(s,!0)}else m[2]&&(f=f.replace("{var}",m[2][h>1?0:1]),v=v.replace("{var}",m[2][c>1?0:1])),l.prop("selected",!1),t.$menu.append(b),h&&p&&(b.append(e("<div>"+f+"</div>")),t.$element.trigger("maxReached.bs.select")),c&&u&&(b.append(e("<div>"+v+"</div>")),t.$element.trigger("maxReachedGrp.bs.select")),setTimeout(function(){t.setSelected(s,!1)},10),b.delay(750).fadeOut(300,function(){e(this).remove()})}}else a.prop("selected",!1),l.prop("selected",!0),t.$menu.find(".selected").removeClass("selected"),t.setSelected(s,!0);t.multiple?t.options.liveSearch&&t.$searchbox.focus():t.$button.focus(),(n!=t.$element.val()&&t.multiple||o!=t.$element.prop("selectedIndex")&&!t.multiple)&&t.$element.change()}}),this.$menu.on("click","li.disabled a, li dt, li .div-contain, .popover-title, .popover-title :not(.close)",function(e){e.target==this&&(e.preventDefault(),e.stopPropagation(),t.options.liveSearch?t.$searchbox.focus():t.$button.focus())}),this.$menu.on("click",".popover-title .close",function(){t.$button.focus()}),this.$searchbox.on("click",function(e){e.stopPropagation()}),this.$menu.on("click",".actions-btn",function(i){t.options.liveSearch?t.$searchbox.focus():t.$button.focus(),i.preventDefault(),i.stopPropagation(),e(this).is(".bs-select-all")?t.selectAll():t.deselectAll(),t.$element.change()}),this.$element.change(function(){t.render(!1)})},liveSearchListener:function(){var t=this,i=e('<li class="no-results"></li>');this.$newElement.on("click.dropdown.data-api",function(){t.$menu.find(".active").removeClass("active"),t.$searchbox.val()&&(t.$searchbox.val(""),t.$lis.not(".is-hidden").removeClass("hide"),i.parent().length&&i.remove()),t.multiple||t.$menu.find(".selected").addClass("active"),setTimeout(function(){t.$searchbox.focus()},10)}),this.$searchbox.on("input propertychange",function(){t.$searchbox.val()?(t.$lis.not(".is-hidden").removeClass("hide").find("a").not(":icontains("+t.$searchbox.val()+")").parent().addClass("hide"),t.$menu.find("li").filter(":visible:not(.no-results)").length?i.parent().length&&i.remove():(i.parent().length&&i.remove(),i.html(t.options.noneResultsText+' "'+t.$searchbox.val()+'"').show(),t.$menu.find("li").last().after(i))):(t.$lis.not(".is-hidden").removeClass("hide"),i.parent().length&&i.remove()),t.$menu.find("li.active").removeClass("active"),t.$menu.find("li").filter(":visible:not(.divider)").eq(0).addClass("active").find("a").focus(),e(this).focus()}),this.$menu.on("mouseenter","a",function(i){t.$menu.find(".active").removeClass("active"),e(i.currentTarget).parent().not(".disabled").addClass("active")}),this.$menu.on("mouseleave","a",function(){t.$menu.find(".active").removeClass("active")})},val:function(e){return void 0!==e?(this.$element.val(e),this.$element.change(),this.render(),this.$element):this.$element.val()},selectAll:function(){null==this.$lis&&(this.$lis=this.$menu.find("li")),this.$element.find("option:enabled").prop("selected",!0),e(this.$lis).not(".disabled").addClass("selected"),this.render(!1)},deselectAll:function(){null==this.$lis&&(this.$lis=this.$menu.find("li")),this.$element.find("option:enabled").prop("selected",!1),e(this.$lis).not(".disabled").removeClass("selected"),this.render(!1)},keydown:function(t){var i,s,n,o,a,l,d,r,h,c,p,u,m={32:" ",48:"0",49:"1",50:"2",51:"3",52:"4",53:"5",54:"6",55:"7",56:"8",57:"9",59:";",65:"a",66:"b",67:"c",68:"d",69:"e",70:"f",71:"g",72:"h",73:"i",74:"j",75:"k",76:"l",77:"m",78:"n",79:"o",80:"p",81:"q",82:"r",83:"s",84:"t",85:"u",86:"v",87:"w",88:"x",89:"y",90:"z",96:"0",97:"1",98:"2",99:"3",100:"4",101:"5",102:"6",103:"7",104:"8",105:"9"};if(i=e(this),n=i.parent(),i.is("input")&&(n=i.parent().parent()),c=n.data("this"),c.options.liveSearch&&(n=i.parent().parent()),c.options.container&&(n=c.$menu),s=e("[role=menu] li:not(.divider) a",n),u=c.$menu.parent().hasClass("open"),!u&&/([0-9]|[A-z])/.test(String.fromCharCode(t.keyCode))&&(c.options.container?c.$newElement.trigger("click"):(c.setSize(),c.$menu.parent().addClass("open"),u=!0),c.$searchbox.focus()),c.options.liveSearch&&(/(^9$|27)/.test(t.keyCode.toString(10))&&u&&0===c.$menu.find(".active").length&&(t.preventDefault(),c.$menu.parent().removeClass("open"),c.$button.focus()),s=e("[role=menu] li:not(.divider):visible",n),i.val()||/(38|40)/.test(t.keyCode.toString(10))||0===s.filter(".active").length&&(s=c.$newElement.find("li").filter(":icontains("+m[t.keyCode]+")"))),s.length){if(/(38|40)/.test(t.keyCode.toString(10)))o=s.index(s.filter(":focus")),l=s.parent(":not(.disabled):visible").first().index(),d=s.parent(":not(.disabled):visible").last().index(),a=s.eq(o).parent().nextAll(":not(.disabled):visible").eq(0).index(),r=s.eq(o).parent().prevAll(":not(.disabled):visible").eq(0).index(),h=s.eq(a).parent().prevAll(":not(.disabled):visible").eq(0).index(),c.options.liveSearch&&(s.each(function(t){e(this).is(":not(.disabled)")&&e(this).data("index",t)}),o=s.index(s.filter(".active")),l=s.filter(":not(.disabled):visible").first().data("index"),d=s.filter(":not(.disabled):visible").last().data("index"),a=s.eq(o).nextAll(":not(.disabled):visible").eq(0).data("index"),r=s.eq(o).prevAll(":not(.disabled):visible").eq(0).data("index"),h=s.eq(a).prevAll(":not(.disabled):visible").eq(0).data("index")),p=i.data("prevIndex"),38==t.keyCode&&(c.options.liveSearch&&(o-=1),o!=h&&o>r&&(o=r),o<l&&(o=l),o==p&&(o=d)),40==t.keyCode&&(c.options.liveSearch&&(o+=1),-1==o&&(o=0),o!=h&&o<a&&(o=a),o>d&&(o=d),o==p&&(o=l)),i.data("prevIndex",o),c.options.liveSearch?(t.preventDefault(),i.is(".dropdown-toggle")||(s.removeClass("active"),s.eq(o).addClass("active").find("a").focus(),i.focus())):s.eq(o).focus();else if(!i.is("input")){var f,v,b=[];s.each(function(){e(this).parent().is(":not(.disabled)")&&e.trim(e(this).text().toLowerCase()).substring(0,1)==m[t.keyCode]&&b.push(e(this).parent().index())}),f=e(document).data("keycount"),f++,e(document).data("keycount",f),v=e.trim(e(":focus").text().toLowerCase()).substring(0,1),v!=m[t.keyCode]?(f=1,e(document).data("keycount",f)):f>=b.length&&(e(document).data("keycount",0),f>b.length&&(f=1)),s.eq(b[f-1]).focus()}/(13|32|^9$)/.test(t.keyCode.toString(10))&&u&&(/(32)/.test(t.keyCode.toString(10))||t.preventDefault(),c.options.liveSearch?/(32)/.test(t.keyCode.toString(10))||(c.$menu.find(".active a").click(),i.focus()):e(":focus").click(),e(document).data("keycount",0)),(/(^9$|27)/.test(t.keyCode.toString(10))&&u&&(c.multiple||c.options.liveSearch)||/(27)/.test(t.keyCode.toString(10))&&!u)&&(c.$menu.parent().removeClass("open"),c.$button.focus())}},hide:function(){this.$newElement.hide()},show:function(){this.$newElement.show()},destroy:function(){this.$newElement.remove(),this.$element.remove()}},e.fn.selectpicker=function(i,s){var n,o=arguments,a=this.each(function(){if(e(this).is("select")){var a=e(this),l=a.data("selectpicker"),d="object"==typeof i&&i;if(l){if(d)for(var r in d)d.hasOwnProperty(r)&&(l.options[r]=d[r])}else a.data("selectpicker",l=new t(this,e.extend({},e.fn.selectpicker.defaults,a.data(),d),s));if("string"==typeof i){var h=i;l[h]instanceof Function?([].shift.apply(o),n=l[h].apply(l,o)):n=l.options[h]}}});return void 0!==n?n:a},e.fn.selectpicker.Constructor=t,e.fn.selectpicker.defaults={style:"btn-default",size:"auto",title:null,selectedTextFormat:"values",noneSelectedText:"Nothing selected",noneResultsText:"No results match",countSelectedText:"{0} of {1} selected",maxOptionsText:["Limit reached ({n} {var} max)","Group limit reached ({n} {var} max)",["items","item"]],width:!1,container:!1,hideDisabled:!1,showSubtext:!1,showIcon:!0,showContent:!0,dropupAuto:!0,header:!1,liveSearch:!1,actionsBox:!1,multipleSeparator:", ",iconBase:"glyphicon",tickIcon:"glyphicon-ok",maxOptions:!1,mobile:!1},e(document).data("keycount",0).on("keydown",".bootstrap-select [data-toggle=dropdown], .bootstrap-select [role=menu], .bootstrap-select-searchbox input",t.prototype.keydown).on("focusin.modal",".bootstrap-select [data-toggle=dropdown], .bootstrap-select [role=menu], .bootstrap-select-searchbox input",function(e){e.stopPropagation()})}(jQuery);