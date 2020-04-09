var doc = new rwDoc;
function rwDoc(){
    this.insert_area = '';
    this.table_obj = '';
    this.table_width = 800;
    this.total_rows = 10;
    this.total_columns = 10;
    this.tr_font_size = 11;
    this.td_font_size = 11;
    this.td_height = 30;
    this.doc_menu = '';
    this.doc_obj = {};
    this.selected_td = {};
    this.table_form = '';
    this.td_style = '';
    this.init_data = '';

    this.init = function( arg_data ){

        this.init_data = arg_data;

        if( document.getElementById( arg_data.element ) ) {
            this.insert_area = document.getElementById( arg_data.element );
        } else {
            console.error( '입력 값 "' + arg_data.element + '" 과 일치하는 태그를 찾을 수 없습니다.');
            return;
        }
        
        if( arg_data.hasOwnProperty('table_width') == true ){
            this.table_width = arg_data.table_width;
        }

        this.table_form = {
            tag : 'table'
            , attr : {
                id : 'doc_table'
                ,style : 'border-collapse: collapse; border-spacing:0; width:'+ this.table_width +'px'
            }
        };

        switch( arg_data.work ){
            case 'w' : {

                if( arg_data.table_data ) {
                    this.table_form = JSON.parse( arg_data.table_data );
                }
        
                
                if( arg_data.data ) {
                    
                    this.doc_obj = JSON.parse( arg_data.data );     
            
                    this.total_rows = Object.keys( this.doc_obj ).length;
        
                    // console.log( Object.keys( this.doc_obj )  );
        
                    this.total_columns = Object.keys( this.doc_obj[ Object.keys( this.doc_obj )[0] ].child ).length;
        
                    this.td_style = 'width:'+ ( this.table_width / this.total_columns ) +'px; height:'+ this.td_height +'px; border:1px solid; font-size:'+ this.td_font_size +'px; text-align:center; ';
        
                                   
                    this.remakeTable();
                    
        
                } else {
                    console.error( '생성될 테이블 데이터가 없습니다.' );
                }

                break;
            }
            case 'r' : {

                if( arg_data.table_data ) {
                    this.table_form = JSON.parse( arg_data.table_data );
                }
        
                
                if( arg_data.data ) {
                    
                    this.doc_obj = JSON.parse( arg_data.data );     
            
                    this.total_rows = Object.keys( this.doc_obj ).length;
        
                    // console.log( Object.keys( this.doc_obj )  );
        
                    this.total_columns = Object.keys( this.doc_obj[ Object.keys( this.doc_obj )[0] ].child ).length;
        
                    this.td_style = 'width:'+ ( this.table_width / this.total_columns ) +'px; height:'+ this.td_height +'px; border:1px solid; font-size:'+ this.td_font_size +'px; text-align:center; ';
        
                                   
                    this.viewTable();
                    
        
                } else {
                    console.error( '생성될 테이블 데이터가 없습니다.' );
                }


            }
            

        }
        
        

    }

    /**
    * html 객체 생성
    */
    this.create = function( arg_tag ){
        
        var result = '';

        if( arg_tag.hasOwnProperty('tag') == true ) {
            
            var new_tag = document.createElement( arg_tag.tag );

            if( arg_tag.hasOwnProperty('attr') == true ) {

                if( arg_tag.attr.hasOwnProperty('class') == true ) {						
                    new_tag.setAttribute('class', arg_tag.attr.class );
                }

                if( arg_tag.attr.hasOwnProperty('id') == true ) {						
                    new_tag.setAttribute('id', arg_tag.attr.id);
                }

                if( arg_tag.attr.hasOwnProperty('type') == true ) {						
                    new_tag.setAttribute('type', arg_tag.attr.type);
                }

                if( arg_tag.attr.hasOwnProperty('name') == true ) {						
                    new_tag.setAttribute('name', arg_tag.attr.name);
                }

                if( arg_tag.attr.hasOwnProperty('title') == true ) {						
                    new_tag.setAttribute('title', arg_tag.attr.title);
                }

                if( arg_tag.attr.hasOwnProperty('src') == true ) {						
                    new_tag.setAttribute('src', arg_tag.attr.src);
                }

                if( arg_tag.attr.hasOwnProperty('style') == true ) {
                    new_tag.setAttribute('style', arg_tag.attr.style);
                }

                if( arg_tag.attr.hasOwnProperty('for') == true ) {						
                    new_tag.setAttribute('for', arg_tag.attr.for);
                }

                if( arg_tag.attr.hasOwnProperty('selected') == true ) {						
                    new_tag.setAttribute('selected', arg_tag.attr.selected);
                }

                if( arg_tag.attr.hasOwnProperty('checked') == true ) {						
                    new_tag.setAttribute('checked', arg_tag.attr.checked);
                }
                
                if( arg_tag.attr.hasOwnProperty('value') == true ) {						
                    new_tag.setAttribute('value', arg_tag.attr.value);
                }

                if( arg_tag.attr.hasOwnProperty('rowspan') == true ) {						
                    new_tag.setAttribute('rowspan', arg_tag.attr.rowspan);
                }

                if( arg_tag.attr.hasOwnProperty('colspan') == true ) {						
                    new_tag.setAttribute('colspan', arg_tag.attr.colspan);
                }

                if( arg_tag.attr.hasOwnProperty('merge_data') == true ) {						
                    new_tag.setAttribute('data-merge', arg_tag.attr.merge_data);
                }

                if( arg_tag.attr.hasOwnProperty('display') == true ) {						
                    new_tag.style.display = arg_tag.attr.display;
                }

                if( arg_tag.attr.hasOwnProperty('width') == true ) {						
                    new_tag.style.width = arg_tag.attr.width;
                }

                if( arg_tag.attr.hasOwnProperty('height') == true ) {						
                    new_tag.style.height = arg_tag.attr.height;
                }

                if( arg_tag.attr.hasOwnProperty('font_size') == true ) {						
                    new_tag.style.fontSize = arg_tag.attr.font_size;
                }
                

            }
            
            if( arg_tag.hasOwnProperty('text') == true ) {
                new_tag.appendChild( document.createTextNode( arg_tag.text ) );
            }
            
            if( arg_tag.hasOwnProperty('child') == true ) {

                if( arg_tag.child.length > 0 ) {
                    for( child_item of arg_tag.child ){		
                        
                        new_tag.appendChild( this.create( child_item ) );
                    }
                } else {						
                    
                    if( arg_tag.child.hasOwnProperty('tag') ) {
                        new_tag.appendChild( this.create( arg_tag.child ) );
                    }
                    
                }
                
            }

            result = new_tag;
            
        } else {
            
            if( arg_tag.hasOwnProperty('text') == true ) {
                result = document.createTextNode( arg_tag.text );
            }

        }

        // console.log( result );
        return result;

    }

    this.viewString = function( arg_tag ){

        var result = '';
        var radio_text = '';
        if( arg_tag.hasOwnProperty('tag') == true ) {
            
            var new_tag = document.createElement( arg_tag.tag );

            if( arg_tag.hasOwnProperty('attr') == true ) {

                if( arg_tag.attr.hasOwnProperty('class') == true ) {						
                    new_tag.setAttribute('class', arg_tag.attr.class );
                }

                if( arg_tag.attr.hasOwnProperty('id') == true ) {						
                    new_tag.setAttribute('id', arg_tag.attr.id);
                }

                if( arg_tag.attr.hasOwnProperty('type') == true ) {						
                    new_tag.setAttribute('type', arg_tag.attr.type);
                }

                if( arg_tag.attr.hasOwnProperty('name') == true ) {						
                    new_tag.setAttribute('name', arg_tag.attr.name);
                }

                if( arg_tag.attr.hasOwnProperty('title') == true ) {						
                    new_tag.setAttribute('title', arg_tag.attr.title);
                }

                if( arg_tag.attr.hasOwnProperty('src') == true ) {						
                    new_tag.setAttribute('src', arg_tag.attr.src);
                }

                if( arg_tag.attr.hasOwnProperty('style') == true ) {
                    new_tag.setAttribute('style', arg_tag.attr.style);
                }

                if( arg_tag.attr.hasOwnProperty('for') == true ) {						
                    new_tag.setAttribute('for', arg_tag.attr.for);
                }

                if( arg_tag.attr.hasOwnProperty('selected') == true ) {						
                    new_tag.setAttribute('selected', arg_tag.attr.selected);
                }

                if( arg_tag.attr.hasOwnProperty('checked') == true ) {						
                    new_tag.setAttribute('checked', arg_tag.attr.checked);
                }
                
                if( arg_tag.attr.hasOwnProperty('value') == true ) {						
                    new_tag.setAttribute('value', arg_tag.attr.value);
                }

                if( arg_tag.attr.hasOwnProperty('rowspan') == true ) {						
                    new_tag.setAttribute('rowspan', arg_tag.attr.rowspan);
                }

                if( arg_tag.attr.hasOwnProperty('colspan') == true ) {						
                    new_tag.setAttribute('colspan', arg_tag.attr.colspan);
                }

                if( arg_tag.attr.hasOwnProperty('merge_data') == true ) {						
                    new_tag.setAttribute('data-merge', arg_tag.attr.merge_data);
                }

                if( arg_tag.attr.hasOwnProperty('display') == true ) {						
                    new_tag.style.display = arg_tag.attr.display;
                }

                if( arg_tag.attr.hasOwnProperty('width') == true ) {						
                    new_tag.style.width = arg_tag.attr.width;
                }

                if( arg_tag.attr.hasOwnProperty('height') == true ) {						
                    new_tag.style.height = arg_tag.attr.height;
                }

                if( arg_tag.attr.hasOwnProperty('font_size') == true ) {						
                    new_tag.style.fontSize = arg_tag.attr.font_size;
                }
                

            }
            
            if( arg_tag.hasOwnProperty('text') == true ) {
                new_tag.appendChild( document.createTextNode( arg_tag.text ) );
            }

            if( arg_tag.hasOwnProperty('child') == true ) {

                if( arg_tag.child.length > 0 ) {
                    for( child_item of arg_tag.child ){		
                        

                        if( child_item.tag == 'input' ) {
                            // console.log( child_item.attr.value );
                            if( child_item.attr.type == 'radio' ) {
                                if( child_item.attr.hasOwnProperty( 'checked' ) == true ) {
                                    
                                    if( child_item.attr.value == 'Y') {
                                        radio_text = '적합';
                                    } else {
                                        radio_text = '부적합';
                                    }
                                    new_tag.appendChild( document.createTextNode( radio_text ) );
                                }
                            } else  {
                                new_tag.appendChild( document.createTextNode( child_item.attr.value ) );
                            }
                            
                        } else {

                            // if(child_item.hasOwnProperty( 'text' ) == true ) {
                            //     new_tag.appendChild( this.viewString( child_item ) );
                            // }
                            // console.log( child_item.tag );
                            if( ( child_item.tag != 'label')  && (child_item.tag != 'br') ) {
                                new_tag.appendChild( this.viewString( child_item ) )
                            }
                            
                            
                        }
                        
                    }
                } else {						
                    
                    if( arg_tag.child.hasOwnProperty('tag') ) {
                        
                        new_tag.appendChild( this.viewString( arg_tag.child ) );
                    }
                    
                }
                
            }

            result = new_tag;
            
        } else {
            
            if( arg_tag.hasOwnProperty('text') == true ) {
                result = document.createTextNode( arg_tag.text );
            }

        }

        // console.log( result );
        return result;
    }

    this.remakeTable = function(){

        var new_table = '';
        var new_tr = '';
    
        new_table = this.create( this.table_form );

        for(var tr_obj in this.doc_obj ){

            // console.log( doc.doc_obj[ tr_obj ] );

            new_tr = this.create({
                tag : this.doc_obj[ tr_obj ].tag
                , attr : {
                    id : this.doc_obj[ tr_obj ].attr.id
                }
            });

            // console.log( new_tr );

            for(var td_obj in this.doc_obj[ tr_obj ]['child'] ){

                // console.log( this.doc_obj[ tr_obj ]['child'][ td_obj ] );
                new_tr.appendChild(	this.create( this.doc_obj[ tr_obj ]['child'][ td_obj ] )	);

            }

            new_table.appendChild( new_tr );
            
        }

        this.createTableAfterHandler( new_table );
    }

    /**
     * view 용 테이블을 생성한다.
     */
    this.viewTable = function(){

        var new_table = '';
        var new_tr = '';
    
        new_table = this.create( this.table_form );

        for(var tr_obj in this.doc_obj ){

            // console.log( doc.doc_obj[ tr_obj ] );

            new_tr = this.create({
                tag : this.doc_obj[ tr_obj ].tag
                , attr : {
                    id : this.doc_obj[ tr_obj ].attr.id
                }
            });

            // console.log( new_tr );

            for(var td_obj in this.doc_obj[ tr_obj ]['child'] ){

                // console.log( this.doc_obj[ tr_obj ]['child'][ td_obj ] );
                new_tr.appendChild(	this.viewString( this.doc_obj[ tr_obj ]['child'][ td_obj ] )	);

            }

            new_table.appendChild( new_tr );
            
            
        }

        this.insert_area.appendChild( new_table );

        this.table_obj = new_table;

        for( item of this.insert_area.getElementsByTagName('td') ) {
            item.style.cursor = '';
        }

        for( item of this.insert_area.getElementsByTagName('th') ) {
            item.style.cursor = '';
        }
        
    }

    /**
     테이블 생성 후처리를 수행한다.
    */
    this.createTableAfterHandler = function( arg_table_obj ) {
        
        this.insert_area.innerHTML = '';

        this.insert_area.appendChild( arg_table_obj );
        
        this.table_obj = arg_table_obj;

        for( item of this.insert_area.getElementsByTagName('td') ) {
            item.style.cursor = '';
        }

        for( item of this.insert_area.getElementsByTagName('th') ) {
            item.style.cursor = '';
        }

        this.domEventHandler({
            selector_type : 'class'
            ,selector : '__doc_td_inputs'
            ,event : 'keyup'
            ,fn : this.inputKeyupHandler
        });

        this.domEventHandler({
            selector_type : 'class'
            ,selector : '__doc_td_radios'
            ,event : 'click'
            ,fn : this.radioClickHandler
        });

        
        
    }

    /**
     * input keyup 이벤트 처리 함수
     */
    this.inputKeyupHandler = function(){

        var selected = this;
        var td_key = selected.id.replace('_input','');
        
        // console.log( td_key );
        // console.log( doc.doc_obj[ doc.getTrKey( td_key ) ]['child']);

        for( var item of doc.doc_obj[ doc.getTrKey( td_key ) ]['child'][ td_key ].child ){				
            
            if( item.tag == 'input' ) {
                if( item.attr.id == selected.id ) {
                    item.attr['value'] = selected.value;
                }
            }
            
            
        }

        // console.log( doc.doc_obj[ doc.getTrKey( selected.id ) ]['child'][ selected.id.replace('_input','') ].child);

    }

    /**
     * radiobox 클릭이벤트
     */
    this.radioClickHandler = function(){
        var selected = this;
        var td_key = selected.id.split('_');
        td_key = td_key[0] + '_' + td_key[1] + '_' + td_key[2] + '_' + td_key[3];

        // console.log( td_key );
        // console.log( selected.id.substr(0, 10) );
        // console.log( doc.doc_obj[ doc.getTrKey( selected.id.substr(0, 10) ) ]['child'] );

        for( var item of doc.doc_obj[ doc.getTrKey( td_key ) ]['child'][td_key].child ){
            // console.log( item );
            if( item.tag == 'span' ) {
                if( item.child[0].attr.id == selected.id ){
                    item.child[0].attr.checked = 'checked';
                } else {
                    delete item.child[0].attr.checked;
                }
            }
            
        }

        // console.log( doc.doc_obj[ doc.getTrKey( selected.id.substr(0, 10) ) ]['child'][selected.id.substr(0, 10)].child );
        // console.log( doc.doc_obj[ doc.getTrKey( selected.id ) ]['child'][ selected.id.substr(0, 10) ].child);
    }

    /**
    * 이벤트 등록 준비 처리 함수
    */
    this.domEventHandler = function( arg_data ){
            
        var get_element = '';
        
        switch( arg_data.selector_type ) {
            case 'id' : {

                get_element = document.getElementById( arg_data.selector );

                break;
            }
            case 'name' : {
                get_element = document.getElementsByName( arg_data.selector );
                break;
            }
            case 'class' : {
                get_element = document.getElementsByClassName( arg_data.selector );
                break;
            }
        }

        if( get_element.length ) {

            for( var item of get_element) {

                arg_data['object'] = item;

                this.addDomEvent( arg_data );

            }
            
        } else {

            arg_data['object'] = get_element;

            this.addDomEvent( arg_data );

        }

    }

    /**
    * 이벤트 등록 함수
    */
    this.addDomEvent = function( arg_data ) {

        try {

            if( arg_data.object.addEventListener ) {
                // ie 외 브라우저
                arg_data.object.addEventListener( arg_data.event, arg_data.fn );
            } else {
                // ie
                arg_data.object.attachEvent( arg_data.event, arg_data.fn );
            }

        } catch( error_info ) {
            console.error( ' addDomEvent -> ' + error_info );
        }

    }

    /**
    * td id로 table 객체의 tr key 값을 반환
    */
    this.getTrKey = function( arg_id ) {
            
        var id_arr = arg_id.split('_');
        
        return id_arr[0] + '_tr_' +  id_arr[ id_arr.length - 2];

    }


} // class