CKEDITOR.plugins.add( 'languages',
{
	requires : [ 'richcombo'],// 'button' ],

	init : function( editor )
	{
	var config = editor.config;
	lang = editor.lang.format;
	 var p=[],
	 labels=[]; 									
		var languages =  CKEDITOR_LANGS;
	        //var languages =	editor.config.languages;                                //for config.languages
		for ( var i = 0 ; i < languages.length ; i++ )
		{	
			/*var parts = languages[i].split( ':' );					   //for config.languages
			p[ i ] = parts[ 0 ] ;
			labels[i]= parts[ 1 ];*/

			p[ i ] = languages[i].code;
			labels[i]= languages[i].name;
		}

		editor.ui.addRichCombo( 'Languages',
			{
				label : 'Language',
				title : 'Language',
				className : 'cke_button_languages',
				panel :
				{
					css : editor.skin.editor.css.concat( config.contentsCss ),
					multiSelect : false,
					attributes : { 'aria-label' : lang.panelTitle }
				},

				init : function()
				{
					//this.startGroup( 'Languages' );
					for ( var n in labels )
					{
						this.add( p[n], labels[ n ]);//.buildPreview(n), n );
					}
				},
				onClick : function( value )
				{ 
				//	var editor;							
				//	if ( editor )
					editor.destroy();
					editor = CKEDITOR.replace( 'editor1',
						{ 
							language : value
						});
				}
				
			});
	}			
});
var CKEDITOR_LANGS=(function(){var b={af:'Afrikaans',ar:'Arabic',bg:'Bulgarian',bn:'Bengali/Bangla',bs:'Bosnian',ca:'Catalan',cs:'Czech',cy:'Welsh',da:'Danish',de:'German',el:'Greek',en:'English','en-au':'English (Australia)','en-ca':'English (Canadian)','en-gb':'English (United Kingdom)',eo:'Esperanto',es:'Spanish',et:'Estonian',eu:'Basque',fa:'Persian',fi:'Finnish',fo:'Faroese',fr:'French','fr-ca':'French (Canada)',gl:'Galician',gu:'Gujarati',he:'Hebrew',hi:'Hindi',hr:'Croatian',hu:'Hungarian',is:'Icelandic',it:'Italian',ja:'Japanese',ka:'Georgian',km:'Khmer',ko:'Korean',ku:'Kurdish',lt:'Lithuanian',lv:'Latvian',mn:'Mongolian',ms:'Malay',nb:'Norwegian Bokmal',nl:'Dutch',no:'Norwegian',pl:'Polish',pt:'Portuguese (Portugal)','pt-br':'Portuguese (Brazil)',ro:'Romanian',ru:'Russian',sk:'Slovak',sl:'Slovenian',sr:'Serbian (Cyrillic)','sr-latn':'Serbian (Latin)',sv:'Swedish',th:'Thai',tr:'Turkish',ug:'Uighur',uk:'Ukrainian',vi:'Vietnamese',zh:'Chinese Traditional','zh-cn':'Chinese Simplified'},c=[];for(var d in b)c.push({code:d,name:b[d]});c.sort(function(e,f){return e.name<f.name?-1:1;});return c;})();
//CKEDITOR.config.languages = [ 'fr:French', 'es:Spanish', 'it:Italian' ];
