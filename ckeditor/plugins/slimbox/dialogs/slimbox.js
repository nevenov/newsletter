CKEDITOR.dialog.add( 'slimbox', function( editor )
{
	return {
		title : 'Settings enarged image',
		minWidth : 450,
		minHeight : 80,
		contents : [
			{
				id : 'tab1',
				label : 'First Tab',
				title : 'First Tab',
				elements : [
					{
						id : 'text',
						type : 'html',
						html :'Title for Lightbox enlarged image:'
					},
					{
						id : 'input0',
						type : 'html',
						html :'<input type="text" name="chili" style="width: 350px; border: 1px #000 solid;" />',
						validate : function(){
							if ( !this.getValue() )
							{
								alert( 'Please, fill the title for Lightbox enlarged image!' );
								return false;
							}

							var element = editor.getSelection().getStartElement();

							if ( element.getName() == 'a' )
							{
								element.setAttribute( 'rel', 'lightbox[]' );
								element.setAttribute( 'title', this.getValue() );
								return true;
							}

							element = element.getParent();

							if ( element.getName() != 'a' )
							{
								alert( 'The selected item is not a valid Lightbox element. You should upload a thumbnail and link it to large image! Then mark the thumbnail and use this button to connect with LightBox' );
								return true;
							}

							element.setAttribute( 'rel', 'lightbox[]' );
							element.setAttribute( 'title', this.getValue() );
							return true;
						}
					}
				]
			}
		]
	};
} );
