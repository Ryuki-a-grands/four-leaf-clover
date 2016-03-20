/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
function sub_color_value(texts){
	var colorl = new RGBColor(texts);
	if(colorl.ok){
		var sub_color="rgb("+Math.floor((255-colorl.r)*90/100+colorl.r)+","+Math.floor((255-colorl.g)*90/100+colorl.g)+","+Math.floor((255-colorl.b)*90/100+colorl.b)+")";
		var colors = new RGBColor(sub_color);
		if(colors.ok){
			var sub_hex = colors.toHex();
		}
	}
	return sub_hex;
}
( function( $ ) {
	var base;
	var text;
	var bdr;
	wp.customize( 'four_leaf_clover_fontsize_value', function( value ) {
		value.bind( function( newval ) {
				$( 'body').css('font-size',newval+'px');
		} );
	} );
	wp.customize( 'four_leaf_clover_search_value', function( value ) {
		value.bind( function( newval ) {
			if(!newval){
				$( 'header .right').css('display','none');
			}else{
				$( 'header .right').css('display','inline');
			}
		} );
	} );
	wp.customize( 'four_leaf_clover_border_value', function( value ) {
		value.bind( function( newval ) {
			if(!base){
				base=$('header').css('border-bottom-color');
			}
			bdr=newval;
			$('header').css('border-bottom','2px '+newval+' '+base);
			$('footer,.comments-list li[id^="li-comment"],.comment-page-link').css('border-top','2px '+newval+' '+base);
		} );
	} );
	wp.customize( 'four_leaf_clover_layout_value', function( value ) {
		value.bind( function( newval ) {
			if(newval=='content-sidebar'){
				$( '#main').css('float','left');
				$( 'aside').css('float','right');
			}else{
				$( '#main').css('float','right');
				$( 'aside').css('float','left');
			}
		} );
	} );
	wp.customize( 'four_leaf_clover_text_color_value', function( value ) {
		value.bind( function( newval ) {
			if(!base){
				base=$('header').css('border-bottom-color');
			}
			if(!newval){
				newval='#000000';
			}
			text=newval;
			sub_base=sub_color_value(base);
			$( 'body,h1 a,.menu a,aside a,#navigation a,.navi a,.footer-post-meta a,.comment-author a,.comment-respond a' ).css( 'color',newval );
			$('#main h2.title a,#main .more a').css('color',newval).css('border-bottom','1px solid '+newval);
			$('#main h2.title a,#main .more a').hover(
				function () {
					$(this).css('color',base).css('border-bottom','1px solid '+base);
				},
				function () {
					$(this).css('color',newval).css('border-bottom','1px solid '+newval);
				}
			);
			$('h1 a,.menu a,aside a,#navigation a,.navi a,.footer-post-meta a,.comment-author a,.comment-respond a').hover(
				function () {
					$(this).css('color',base).css('border-bottom','1px solid '+base);
				},
				function () {
					$(this).css('color',newval).css('border-bottom','none ');
				}
			);
			$('#main #page-link ul a li').css('color',newval);
			$('#main #page-link ul a li').hover(
				function () {
					$(this).css('color',base).css('border','1px solid '+base).css('background-color',sub_base);
				},
				function () {
					$(this).css('color',newval).css('border','1px solid '+newval).css('background-color','transparent');
				}
			);
			$('span.page-numbers,a.page-numbers').css('color',newval).css('border','1px solid '+newval);
			$('a.page-numbers').hover(
				function () {
					$(this).css('color',base).css('border','1px solid '+base).css('background-color',sub_base);
				},
				function () {
					$(this).css('color',newval).css('border','1px solid '+newval).css('background-color','transparent');
				}
			);
			$('#wp-calendar tbody a').hover(
				function () {
					$(this).css('color',base).css('border-bottom','none');
				},
				function () {
					$(this).css('color',newval).css('border-bottom','none');
				}
			);
			$('#main .main img,.writer_icon,#main div.wp-caption,#main #page-link ul li').css('border','1px solid '+newval);
			
		} );
	} );
	wp.customize( 'four_leaf_clover_base_color_value', function( value ) {
		value.bind( function( newval ) {
			if (!text){
				text=$('body').css('color');
			}
			if(!bdr){
				bdr=$('header').css('border-bottom-style');
			}
			if(!newval){
				newval='#9acd32';
			}
			base=newval;
			sub_base=sub_color_value(base);
			var css = '#main .main blockquote:before,#main .comment-body blockquote:before,#main .main blockquote:after,#main .comment-body blockquote:after{color:'+newval+'}';
			var style = document.createElement('style');
			style.appendChild(document.createTextNode(css));
			document.getElementsByTagName('head')[0].appendChild(style);
			$('#main .main td,#main .main th,#main .comment-body td,#main .comment-body th').css('border-bottom','1px solid '+newval);
			$('#main .main blockquote,#main .comment-body blockquote').css('background-color',sub_base).css('border-left','5px solid '+newval);
			$('header').css('border-bottom','2px '+bdr+' '+newval);
			$('footer,.comments-list li[id^="li-comment"],.comment-page-link').css('border-top','2px '+bdr+' '+newval);
			$('#main article.sticky,.bypostauthor,#main .main tfoot td,#main .comment-body tfoot td,#main .main th,#main .comment-body th,#main .main tbody tr:nth-child(even),#main .comment-body tr:nth-child(even)').css('background-color',sub_base);
			$('#today').css('border','1px solid '+newval);

			$('a').hover(
				function () {
					$(this).css('color',newval).css('border-bottom','1px solid '+newval);
				},
				function () {
					$(this).css('color','#00f').css('border-bottom','1px solid #00f');
				}
			);
			$('#main h2.title a,#main .more a').hover(
				function () {
					$(this).css('color',newval).css('border-bottom','1px solid '+newval);
				},
				function () {
					$(this).css('color',text).css('border-bottom','1px solid '+text);
				}
			);
			$('h1 a,.menu a,aside a,#navigation a,.navi a,.footer-post-meta a').hover(
				function () {
					$(this).css('color',newval).css('border-bottom','1px solid '+newval);
				},
				function () {
					$(this).css('color',text).css('border-bottom','none ');
				}
			);
			$('nav ul>li>ul>li>a').hover(
				function () {
					$(this).css('border','1px solid '+newval);
				},
				function () {
					$(this).css('border','1px solid #aaa');
				}
			);
			$('#wp-calendar tbody a').hover(
				function () {
					$(this).css('color',newval).css('border-bottom','none');
				},
				function () {
					$(this).css('color',text).css('border-bottom','none');
				}
			);
			$('.button,button,input[type="submit"]:not("#search-submit"),input[type="reset"],input[type="button"]').css('border','1px solid '+newval).css('color',newval).css('background',sub_base);
			$('.button,button,input[type="submit"]:not("#search-submit"),input[type="reset"],input[type="button"]').hover(
				function () {
					$(this).css('border','1px solid '+sub_base).css('color',sub_base).css('background',newval);
				},
				function () {
					$(this).css('border','1px solid '+newval).css('color',newval).css('background',sub_base);
				}
			);
			$('input[type="text"],input[type="search"],input[type="password"],input[type="email"],input[type="search"],textarea').focus(
				function () {
					$(this).css('border','1px solid '+newval).css('box-shadow','0 0 10px '+newval);
				}
			);
			$('input[type="text"],input[type="search"],input[type="password"],input[type="email"],input[type="search"],textarea').blur(
				function () {
					$(this).css('border','1px solid #ddd').css('box-shadow','none');
				}
			);
			$('a.page-numbers').hover(
				function () {
					$(this).css('color',newval).css('border','1px solid '+newval).css('background-color',sub_base);
				},
				function () {
					$(this).css('color',text).css('border','1px solid '+text).css('background-color','transparent');
				}
			);
		} );
	} );
} )( jQuery );
