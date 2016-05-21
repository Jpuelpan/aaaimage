$(function(){	
	$('#upload').hover(function(){
			$(this).children('a:eq(0)').css('visibility','visible');
		},function(){
			$(this).children('a:eq(0)').css('visibility','hidden');
	});

	$('.change-upload').click(function(){
		($(this).hasClass('link-pc')) ? $(this).attr('title', text['up-link']) : $(this).attr('title', text['up-pc']) ;
		$(this).toggleClass('link-pc');
		$('.upload-pc , .upload-link').toggleClass('activo').toggle();
	});

	$('.state-image').click(function(){
		($(this).hasClass('image-private')) ? $(this).attr('title', text['private-img'] ) : $(this).attr('title', text['public-img'] ) ;
		($(this).hasClass('image-private')) ? $('.state-input').val('Publica') : $('.state-input').val('Privada') ;
		$(this).toggleClass('image-private');
	});
	
	if(!$.browser.webkit){ $('#menu a').css('padding-bottom','11px'); }
	if($.browser.opera){ $('#menu a').css('font-size','12px'); }
	
	$('.Wrapper-text input[type="text"], .Wrapper-text input[type="password"]').focus(function(){
		$(this).parent('div').addClass('Wrapper-text-click');
	}).blur(function(){
		$(this).parent('div').removeClass('Wrapper-text-click');
	});
	
	/*
	$('.option-link').hover(function(){
		$(this).children('i').css('background-position','0px 1px');
	},function(){
		$(this).children('i').css('background-position','0px -14px');
	});
	*/
	
	page.ActualPage();
	
});

var imagen = {
	eliminar:function(token,ds){
		$.ajax({
			type:'POST',
			url:'../ajax/eliminar-imagen.php',
			data:'token='+token+'&ds='+ds,
			dataType:'json',
			success:function(r){
				GlobalAlert('Gscs',''+r+'');
			}
		});
	},
	fav:function(token){
		if(token == 'null'){
			 GlobalAlert('Aalt',text['no_session']);
		}else{
			$.ajax({
				type:'POST',
				url:'../ajax/agregar-favorito.php',
				data:'token='+token,
				dataType:'json',
				success:function(r){
					if(r.res == "c"){
						GlobalAlert(r.gbl,r.txt);
						$('#AddFav').removeAttr('onclick').parent('div').addClass('BtnDsbl');
					}else{
						GlobalAlert(r.gbl,r.txt);
					}
				}
			});
		}
	},
	del_fav:function(id){
		$.ajax({
			type:'POST',
			url:'./ajax/eliminar-favorito.php',
			data:'id='+id,
			dataType:'json',
			success:function(r){
				if(r.res == 'ok'){
					$('#fav_'+id).fadeOut('normal',function(){ $(this).remove(); });
				}else{
					GlobalAlert(r.glb,r.txt);
				}
			}
		});
	}
}


var page = {
	back:function(){
		var Pagina = parseInt($('#ActualPage').val()) - 1;
		if(Pagina < 0){
			GlobalAlert('Gscs',text['end_img']); 
			return false;
		}
		$.ajax({ type:'POST',url:'ajax/paginar-imagenes.php',data:'page='+Pagina,
				success:function(p){
				$('#ActualPage').val(Pagina);
				window.location="#pagina/"+Pagina;
				$('.Wrap-images').html(p);
			}
		});
	},
	forward:function(){
		var Pagina = parseInt($('#ActualPage').val()) + 1;
		if(Pagina < 0){
			GlobalAlert('Gscs',text['end_img']); 
			return false;
		}
		$.ajax({ type:'POST',url:'ajax/paginar-imagenes.php',data:'page='+Pagina,
				success:function(p){
				if(p == "end"){
					GlobalAlert('Gscs',text['end_img']); 
					return false;
				}
				$('#ActualPage').val(Pagina);
				window.location="#pagina/"+Pagina;
				$('.Wrap-images').html(p);
			}
		});
	},
	ActualPage:function(){
		var Page = document.location.hash;
		var SplitPage = Page.split("/");
		if(SplitPage[0] == '#pagina'){
			if(SplitPage[1] > 0){
				$.ajax({ type:'POST',url:'ajax/paginar-imagenes.php',data:'page='+SplitPage[1],
					success:function(p){
						$('#ActualPage').val(SplitPage[1]);
						$('.Wrap-images').html(p);
					}
				});
			}else{
				window.location="#";
			}
		}
	}
}

/*
var select = {
	open:function(id){
		var Raiz = $(id).parents('.Wrapper-select');
		var selected = Raiz.children('input[type="hidden"]').val();
		$(id).toggleClass('option-link-selected-active');
		Raiz.children('.Wrapper-option-list').toggle();
		Raiz.children('.Wrapper-option-list').children('a:eq(' + selected + ')').addClass('option-link-active');
	},
	close:function(){
		$('.option-link-selected').toggleClass('option-link-selected-active').parents('.Wrapper-select').children('.Wrapper-option-list').toggle();
	},
	choose:function(id){
		var Raiz = $(id).parents('.Wrapper-select');
		var Selection = Raiz.children('input[type="hidden"]');
		Raiz.children('.Wrapper-option-list').children('a:eq(' + Selection.val() + ')').removeClass('option-link-active');
		Selection.val('' + id.index() + '');
		Raiz.children('.Wrapper-option').children('a').html('' + $(id).attr('title') + ' <span class="right"></span> ');
	}
}
*/

var select = {
	open:function(id){
		var Raiz = $(id).parent();
		var Selected = Raiz.children('input[type="hidden"]').val();
		Raiz.children('.SelectMenuWrap').toggle().children('ul').children('li:eq(' + Selected + ') a').addClass('ThisOptionSelected');
		$(id).toggleClass('BtnSelectActive');
		if($(id).hasClass('HoverEffect')){ $(id).removeClass('HoverEffect').addClass('BtnSelectOnHover'); return;}
		if($(id).hasClass('BtnSelectOnHover')) $(id).removeClass('BtnSelectOnHover').addClass('HoverEffect');
	},
	close:function(){
		$('.option-link-selected').toggleClass('option-link-selected-active').parents('.Wrapper-select').children('.Wrapper-option-list').toggle();
	},
	choose:function(id){
		var Raiz = $(id).parents('.Wrapper-select');
		var Selection = Raiz.children('input[type="hidden"]');
		Raiz.children('.Wrapper-option-list').children('a:eq(' + Selection.val() + ')').removeClass('option-link-active');
		Selection.val('' + id.index() + '');
		Raiz.children('.Wrapper-option').children('a').html('' + $(id).attr('title') + ' <span class="right"></span> ');
	}
}		






function GlobalAlert(tipo,texto){
	if($('.GlobalAlert').length > 0) return false;
	$('body').append("<div class='GlobalAlert "+tipo+"' style='display:none;'></div>");
	$(".GlobalAlert").html("<p>"+texto+"</p>").fadeIn(200).delay(2500).fadeOut(300, function(){ $(this).remove(); });
}

$(document).mouseup(function(){
	if( $('.option-link-selected').hasClass('option-link-selected-active') ){
		select.close();
	}
});

var text = Array();
text['up-link'] = 'Subir desde URL';
text['up-pc'] = 'Subir desde mi computador';
text['public-img'] = 'Subir como p&uacute;blica';
text['private-img'] = 'Subir como privada';
text['reg_name1'] = 'El nombre es demasiado corto.';
text['no_session'] = 'Inicie sesión para realizar esta acción';
text['end_img'] = 'No hay mas paginas';

//Cookie
jQuery.cookie=function(key,value,options){if(arguments.length>1&&String(value)!=="[object Object]"){options=jQuery.extend({},options);if(value===null||value===undefined){options.expires=-1}if(typeof options.expires==="number"){var days=options.expires,t=options.expires=new Date();t.setDate(t.getDate()+days)}value=String(value);return(document.cookie=[encodeURIComponent(key),"=",options.raw?value:encodeURIComponent(value),options.expires?"; expires="+options.expires.toUTCString():"",options.path?"; path="+options.path:"",options.domain?"; domain="+options.domain:"",options.secure?"; secure":""].join(""))}options=value||{};var result,decode=options.raw?function(s){return s}:decodeURIComponent;return(result=new RegExp("(?:^|; )"+encodeURIComponent(key)+"=([^;]*)").exec(document.cookie))?decode(result[1]):null};
