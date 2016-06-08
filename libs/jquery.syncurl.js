/**
 * jQuery syncTranslit plugin
 *
 * Copyright (c) 2009 Snitko Roman
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * @author 	Roman Snitko snowcore.net@gmail.com
 * @link http://snowcore.net/
 * @version 0.0.7
 */
;(function($){
    $.fn.syncTranslit = function(options) {
        var opts = $.extend({}, $.fn.syncTranslit.defaults, options);
        return this.each(function() {
            $this = $(this);
            var o = $.meta ? $.extend({}, opts, $this.data()) : opts;
            var $destination = $('#' + opts.destination);
            o.destinationObject = $destination;
            
            // IE always sucks :)
            if (!Array.indexOf) {
                Array.prototype.indexOf = function(obj) {
                    for (var i = 0; i < this.length; i++) {
                        if (this[i] == obj) {
                            return i;
                        }
                    }
                    return -1;
                }
            }
            
            $this.keyup(function(){
            	var str = $(this).val();
				
				 
				
				
				
            	var result = '';
            	for (var i = 0; i < str.length; i++) {
            		result += $.fn.syncTranslit.transliterate(str.charAt(i), o)
            	}
            	var regExp = new RegExp('[' + o.urlSeparator + ']{2,}', 'g');
            	result = result.replace(regExp, o.urlSeparator);
            	$destination.val(result);
				
            })
        });
    };

	
    /**
     * Transliterate character
     * @param {String} character
     * @param {Object} opts
     */
    $.fn.syncTranslit.transliterate = function(char, opts) {
    	var charIsLowerCase = true, trChar;
    	if (char.toLowerCase() != char) {
    		charIsLowerCase = false;
    	}
    	
    	char = char.toLowerCase();
    	
    	var index = opts.dictOriginal.indexOf(char);
    	if (index == -1) {
    		trChar = char;
    	} else {
    		trChar = opts.dictTranslate[index];
    	}
    	
    	if (opts.type == 'url') {
	    	var code = trChar.charCodeAt(0);
	    	if (code >= 33  && code <= 44
	    		|| code >= 59  && code <= 64
	    		|| code >= 91  && code <= 96 && code != 95
	    		|| code >= 123 && code <= 126
	    		|| code >= 1072
	    	) {
	    		return '';
	    	}
	    	if (trChar == ' ' || trChar == '-') {
	    		return opts.urlSeparator;
	    	}
    	}
    	
    	if (opts.caseStyle == 'upper') {
    		return trChar.toUpperCase();
    	} else if (opts.caseStyle == 'normal') {
    		if (charIsLowerCase) {
    			return trChar.toLowerCase();
    		} else {
    			return trChar.toUpperCase();
    		}
    	}
	    return trChar;
    };
    
    /**
     * Default options
     */
    $.fn.syncTranslit.defaults = {
        /**
         * Dictionaries
         */
        dictOriginal:  ['а', 'б', 'в', 'г', 'д', 'е',
                        'ё', 'ж', 'з', 'и', 'й', 'к',
                        'л', 'м', 'н', 'о', 'п', 'р',
                        'с', 'т', 'у', 'ф', 'х', 'ц',
                        'ч', 'ш', 'щ', 'ъ', 'ы', 'ь',
                        'э', 'ю', 'я',
                        'і', 'є', 'ї', 'ґ',
						'à', 'á', 'â', 'ã', 'ä', 
						'å', 'æ', 'ç', 'è', 'é', 'ê', 
						'ë', 'ì', 'í', 'î', 'ï', 'ð',
						'ñ', 'ò', 'ó', 'ô', 'õ', 'ö',
						'ø', 'ù', 'ú', 'û', 'ü', 'ý'
                        ],
        dictTranslate: ['a', 'b', 'v', 'g', 'd', 'e',
                        'e', 'zh','z', 'i', 'j', 'k',
                        'l', 'm', 'n', 'o', 'p', 'r',
                        's', 't', 'u', 'f', 'h', 'ts',
                        'ch','sh','sch', '', 'y', '',
                        'e', 'ju', 'ja',
                        'i', 'je', 'ji', 'g',
						'a', 'a', 'a', 'a', 'a', 
						'a', 'a', 'c', 'e', 'e', 'e', 
						'e', 'i', 'i', 'i', 'i', 'o',
						'n', 'o', 'o', 'o', 'o', 'o',
						'o', 'u', 'u', 'u', 'u', 'y'
                        ],
        
        /*
         * Case transformation: normal, lower, upper
         */
        caseStyle: 'lower',
        
        /*
         * Words separator in url
         */
        urlSeparator: '-',
        
        /*
         * Transliteration type: raw or url
         *    url - used for transliterating text into url slug
         *    raw - raw transliteration (with special characters)
         */
        type: 'url'
    };
})(jQuery);