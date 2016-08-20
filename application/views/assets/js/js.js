(function( $ ) {
	$.fn.sSuggestion = function(str,url,ids) {
		$(this).keyup(function(){
			var inp = $(this);
			$(str).append('<div id="txtHint"></div>');
			$.post(url+'?'+$(this).val(), function(html) {
				var obj = jQuery.parseJSON(html);
				res = '';
				if (obj.length > 0) {
					$.each( obj, function( key, value ) {
						res += '<div class="autocomplete-suggestion" data-index="'+value.d+'" ids="'+value.i+'">'+value.n+'</div>';
					});
				}
				else {
					res = '<div class="autocomplete-suggestion">No Suggestion</div>';
				}
				$("#txtHint").html(res);
			});
			
			$(document).ajaxComplete(function(){
				placingTxt(inp,ids);
			});
		});
		
		var placingTxt = function(placed,ids) {
			$('div#txtHint > div.autocomplete-suggestion').click(function(){
				if ($(this).html() != 'No Suggestion') {
					if (ids) {
						$('input[name="'+ids+'"]').val($(this).attr('ids'));
					}
					console.log(placed);
					placed.val($(this).html());
				}
				
				$('div#txtHint').remove();
			});
		};
	};
	
	$.fn.postTMP = function(obj) {
		if( $('form').length == 0 ) return false;
		var obj = jQuery.parseJSON( obj );
		var target = '';
		$.each( obj, function( key, value ) {
			target = $('[name="'+key+'"]');
			if ( target.is( 'input[type="text"]' ) ) {
				$('form input[name="'+key+'"]').val(value);
			}
			else if ( target.is( 'select' ) ) {
				$('form select[name="'+key+'"]').val(value);
			}
			else if ( target.is( 'textarea' ) ) {
				$('form textarea[name="'+key+'"]').val(value);
			}
		});
	};
}(jQuery));

function print_data(url, title) {
	var left = (screen.width/2)-(860/2);
	var top = (screen.height/2)-(400/2);
	window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width=860, height=400, top='+top+', left='+left);
}
	
function formatharga(num,element) {
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
		num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
		cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+
		num.substring(num.length-(4*i+3));
	element.value = num;
}

function formatharga2(num) {
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
		num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
		cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+
		num.substring(num.length-(4*i+3));
	return num;
}
