CKEDITOR.editorConfig = function( config ) {
    config.height = 150;

    config.toolbarGroups = [
        { name: 'document',	   groups: [ 'mode', 'document' ] },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },

        { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
        { name: 'styles' },
    ];

    config.removeButtons = 'Underline,Subscript,Superscript,Iframe,Styles,Font,FontSize,CreateDiv,Blockquote,Smiley,SpecialChar,Newpage,Table';
    config.removePlugins = 'flash,iframe,,smiley,tabletools,maximize,showblocks,newpage,pagebreak';
    config.format_tags = 'p;h2;h3;h4;h5;h6;pre';



};
