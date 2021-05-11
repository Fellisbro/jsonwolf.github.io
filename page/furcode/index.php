﻿<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Furcode Generator</title>
<script src="cdn-cgi/apps/head/_qzlZTmQmSTV8K-J1c0ZQg-72hk.js"></script><script type="cdef8ac64033727dc743dca7-text/javascript" src="ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="cdef8ac64033727dc743dca7-text/javascript" src="ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<link type="text/css" href="ajax/libs/jqueryui/1.8.18/themes/redmond/jquery-ui.css" rel="stylesheet" rev="stylesheet">
<style>
html, body {
    margin: 0px;
    padding: 0px 0px 50px 0px;
    font-family: sans-serif;
}

nav {
    position: fixed;
    top: 0px;
    right: 0px;
    z-index: 100;
    padding: 3px 7px 4px 10px;
    border-bottom-left-radius: 15px;
    background-color: #ccc;
    box-shadow: 0px 4px 15px 0px rgba(0, 0, 0, 0.2);
}

header {
    text-align: center;
}

.outer, .inner {
    margin: 20px 20px;
    border: 1px solid #A6C9E2;
    border-radius: 10px;
}
.outer > h1, .inner > h2 {
    margin-top: 0px;
    margin-bottom: 0px;
    padding-left: 20px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    background-color: #eee;
    background-image: -webkit-gradient(
        linear,
        0% 0%,
        0% 100%,
        from(#eee),
        to(#fff)
    );
    background-image: -moz-linear-gradient(
        0% 100% 90deg,
        #fff,
        #eee
    );
}
h1, h2 .sechead, h1 a:link, h1 a:visited, h1 a:active {
    color: #2E6E9E;
    text-decoration: none;
}
.outer h1 {
    margin-bottom: -10px;
}
.inner {
    padding: 0px 15px 15px 15px;
}
.inner h2 {
    margin: 0px -15px 10px -15px;
}

h2 .btns {
    font-size: 0.6em;
    margin: 0px 5px 0px 10px;
    float: right;
}
.codetbl {
    width: 100%;
    display: none;
}
.codetbl, .codetbl th, .codetbl td {
    border: 1px solid #A6C9E2;
    border-collapse: collapse;
}
.codetbl th, .codetbl td {
    padding: 2px 4px;
}
.codetbl tbody [rowspan] {
    background-color: #eee;
    background-image: -webkit-gradient(
        linear,
        0% 0%,
        0% 100%,
        from(#eee),
        to(#fff)
    );
    background-image: -moz-linear-gradient(
        0% 100% 90deg,
        #fff,
        #eee
    );
}
.codetbl .ui-button {
    font-size: 1.1em;
    font-family: monospace;
}
.codetbl .ui-button-icon-only {
    font-size: 0.9em;
}
.codetbl th[rowspan] {
    vertical-align: top;
}

.codetbl .c_now, .codetbl .c_fut {
    width: 10px; /* minimum width */
}
.codetbl td .ui-button {
    width: 100%;
}

.just-icon {
    background: none;
    border: none;
}
.just-icon span {
    display: inline-block;
}
.sectoggle {
    margin-left: -13px;
    margin-right: -3px;
    cursor: pointer;
}

footer {
    position: fixed;
    bottom: 0px;
    left: 0px;
    width: 100%;
    margin: 0px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    background-color: #ccc;
    box-shadow: 0px -4px 15px 0px rgba(0, 0, 0, 0.2);
}
footer table {
    width: 100%;
    margin: 0px;
    padding: 0px 10px;
}
footer table td {
    padding: 0px;
}
footer h1 {
    display: inline;
    float: left;
    font-size: 1.5em;
    padding: 0px 10px 0px 0px;
}
footer textarea {
    width: 99%;
}
</style>
<script type="cdef8ac64033727dc743dca7-text/javascript">
$(function(){
    // Auto-generate IDs for named radios/checkboxes
    $(':radio[name][!id], :checkbox[name][!id]').each(function(){
        this.id = this.name.replace(/[\[\]]/g, '_') + "_" + ($(this).data('custom') ? 'custom_' : '') + this.value.replace(/[^a-z0-9\?~#!$\-+*]/ig, '_');
    });

    // Set-up the "option" buttons
    $(':radio[name*="[opt]"], :checkbox[name*="[opt]"]').each(function(){
        var title = "",
            text = "",
            icon = '',
            showText = true;
        
        switch (this.value) {
            case '':
                title = 'Clear the selection of these options';
                text = 'Clear';
                icon = 'cancel';
                showText = false;
                break;
            case '?':
                title = 'I\'m unsure';
                text = 'Unsure';
                icon = 'help';
                break;
            case '~':
                title = 'This is an approximation';
                text = 'Approx';
                icon = 'transferthick-e-w';
                break;
            case '!':
                title = 'I refuse to prticipate in this category';
                text = 'Refuse';
                icon = 'notice';
                break;
            case '#':
                title = 'Mind your own business!';
                text = 'Private';
                icon = 'locked';
                break;
            case '$':
                title = 'I make a significant amount of money from this!';
                text = 'Professional';
                icon = 'star';
                break;
        }
        
        var lbl = $("<label>")
                .attr('for', this.id)
                .attr('title', title)
                .text(text)
                .insertAfter(this);
        
        $(this).button({
            icons: {
                primary: "ui-icon-" + icon
            },
            text: showText
        }).click(function(){
            var v = $('[name="' + this.name + '"]:checked').val();
            var toggleBtn = $(this).closest('h2').find('.sectoggle');
            if (v == "!" || v == "#") {
                toggleBtn.trigger('collapse');
            } else {
                toggleBtn.trigger('expand');
            }
        });
    });
    
    // Set up the "clear" buttons
    $('.codetbl :radio[value=""]').each(function(){
        $("<label>").attr('for', this.id).append($("<em>Clear</em>")).insertAfter(this);
    });
    
    // Set the text for radios/checkboxes with a value but no existing text
    $('.codetbl :radio[value!=""][title!=""], .codetbl :checkbox[value!=""][title!=""]').each(function(){
        $("<label>").attr('for', this.id).text(this.title).after(" ").insertAfter(this);
        $(this).removeAttr('title');
    });
    
    // Turn everything into jQuery UI buttons
    var tables = $('.codetbl');
    function buttoniseThings(i) {
        $(':radio, :checkbox', tables[i]).button();
        tables[i].style.display = 'table';
        
        if (tables.length > ++i) {
            window.setTimeout(function(){buttoniseThings(i);}, 0);
        }
    }
    window.setTimeout(function(){buttoniseThings(0);}, 0);
    
    // And create button-sets for the rows of option buttons
    $('div h2 .bset').buttonset();
    
    // Set up the behaviour of "clear" buttons. They're radio buttons, so automatically clear the values of other
    //  buttons in the same group, but we don't want the "clear" button to remain "checked" (both for aesthetic reasons
    //  and so that the resulting code doesn't contain a blank prefix character), so we uncheck it here
    $('.btns :radio[value=""], .codetbl :radio[value=""]').change(function(){
       var btn = $(this);
       window.setTimeout(function(){
           btn.prop('checked', false).button('refresh');
           updateCodeDisplay();
       }, 50);
    });
    
    // Set up the "clear" buttons, but only the ones inside tables/lists of values (i.e. NOT with the "options" button
    //  set)
    $('.codetbl :radio[value=""]').css({
       'width': '20px',
       'height': '20px'
    }).button('option', {
       text: false,
       icons: {
           primary: 'ui-icon-cancel'
       }
    });
    
    // Handle showing/hiding the various sections
    $('.sectoggle').hover(function(){
        // Just apply the "hover" state
        $(this).removeClass('ui-state-default').addClass('ui-state-hover');
    }, function(){
        // Remove the "hover" state
        $(this).removeClass('ui-state-hover').addClass('ui-state-default');
    }).bind('expand', function(){
        var $this = $(this);
        var icon = $this.find('.ui-icon');
        var sec = $this.closest('.inner').find('section');
        
        if (!sec.is(':visible')) {
            icon.removeClass('ui-icon-carat-1-e').addClass('ui-icon-carat-1-se');
            sec.show("blind", "fast", function(){
                icon.removeClass('ui-icon-carat-1-se').addClass('ui-icon-carat-1-s');
            });
        }
    }).bind('collapse', function(){
        var $this = $(this);
        var icon = $this.find('.ui-icon');
        var sec = $this.closest('.inner').find('section');
        
        if (sec.is(':visible')) {
            icon.removeClass('ui-icon-carat-1-s').addClass('ui-icon-carat-1-se');
            sec.hide("blind", "fast", function(){
                icon.removeClass('ui-icon-carat-1-se').addClass('ui-icon-carat-1-e');
            });
        }
    }).click(function(){
        // Actually show/hide the content
        var $this = $(this);
        var sec = $this.closest('.inner').find('section');
        
        if (sec.is(':visible')) {
            $this.trigger('collapse');
        } else {
            $this.trigger('expand');
        }
    });
    
    // These define the order in which different code types will be joined
    var INDEX_PREFIX = 5;
    var INDEX_PREFIX_MOD = 7;
    var INDEX_MAIN = 10;
    var INDEX_MOD_0 = 30;
    var INDEX_MOD_1 = 31;
    var INDEX_MOD_2 = 32;
    var INDEX_MOD_3 = 33;
    var INDEX_MOD_4 = 34;
    var INDEX_MOD_5 = 35;
    var INDEX_OPT_UNSURE = 41;
    var INDEX_OPT_APPROX = 42;
    var INDEX_OPT_MONEY = 44;
    
    var I_NOW = 0;
    var I_FUTURE = 1;
    
    var FLAG_REFUSE = "!";
    var FLAG_PRIVATE = "#";
    
    // If a prefix is listed in this array, it will be removed from the output code if it exists with no modifiers
    //  (e.g. the "F" [furry species] code is useless unless a specific species is also selected)
    var codesThatMakeNoSenseAlone = ['F'];
    
    // This function performs the hard work of converting the selected options into the output code
    function updateCodeDisplay() {
        // The code parts are stored in an object of {prefix: [[now,sub,codes],[future,sub,codes]]}
        var parts = {};
        
        // Used to parse the field names, e.g. F[fut][mod][1]
        var nameRegex = /^([A-Z]+)\[([A-Z]+)\](?:\[([A-Z]+)\](?:\[(\d+)\])?)?/i;
        
        // First create our object mapping prefixes to subcodes;
        // Find all checked radios/checkboxes...
        $(':checked').each(function(){
            // ... with a name that matches the regex
            if (nameRegex.exec(this.name)) {
//                console.log(this.name);
                var prefix = RegExp.$1;
//                console.log("Prefix:", prefix);
                
                if (this.value == "!" || this.value == "#") {
                    // Private or refuse answer
                    parts[prefix] = this.value;
                    return;
                }
                
                if (parts[prefix] == undefined) {
                    parts[prefix] = [[],[]]; // now & future
                } else if (!$.isArray(parts[prefix])) {
                    // Probably been set to refuse/private
                    return;
                }
                
                var val = this.value;
                if (val == " ") {
                    // This is a "bare" code with just the prefix; no "++" or "--"-type suffixes
                    val = "";
                }
                
                var nowOrFut = (RegExp.$2 == 'fut') ? I_FUTURE : I_NOW;
                
                // Figure out what position this subcode needs to be in
                var index = INDEX_MAIN;
                if (RegExp.$3) {
                    switch (RegExp.$3) {
                        case 'pmod':
                            index = INDEX_PREFIX_MOD;
                            break;
                        case 'opt':
                            switch (this.value) {
                                case '?': index = INDEX_OPT_UNSURE; break;
                                case '~': index = INDEX_OPT_APPROX; break;
                                case '$': index = INDEX_OPT_MONEY; break;
                            }
                            break;
                        case 'mod':
                            if (RegExp.$4) {
                                switch (RegExp.$4) {
                                    case '0': index = INDEX_MOD_0; break;
                                    case '1': index = INDEX_MOD_1; break;
                                    case '2': index = INDEX_MOD_2; break;
                                    case '3': index = INDEX_MOD_3; break;
                                    case '4': index = INDEX_MOD_4; break;
                                    case '5': index = INDEX_MOD_5; break;
                                }
                            }
                            break;
                    }
                }
                
                if ($(this).data('custom')) {
                    // Custom-type selections should include the entered custom value
                    if ($(this).data('customjustvalue')) {
                        val += $('input:text[name="' + this.name + '"]').val();
                    } else {
                        val += "[" + $('input:text[name="' + this.name + '"]').val() + "]";
                    }
                }
                
                if (this.name.substring(this.name.length - 2, this.name.length) == "[]") {
                    // Array of choices, like a "select some of these modifiers" section
                    if (parts[prefix][nowOrFut][index] == undefined) {
                        parts[prefix][nowOrFut][index] = [];
                    }
                    parts[prefix][nowOrFut][index].push(val);
                } else {
                    parts[prefix][nowOrFut][index] = val;
                }
            }
        });
        
        function collapseSubcodesToString(codes) {
            var codeparts = codes;
            for (var kk in codeparts) {
                if ($.isArray(codeparts[kk])) {
                    codeparts[kk] = codeparts[kk].join('');
                }
            }
            return codeparts.join('');
        }
        
        // Now convert the object to a string
        console.log(parts);
        var code = "";
        for (var k in parts) {
            var codePart;
            if (parts[k] === FLAG_REFUSE) {
                codePart = "!" + k;
            } else if (parts[k] == FLAG_PRIVATE) {
                codePart = k + "#";
            } else {
                // Separate for now & future
                var nowCodePart = collapseSubcodesToString(parts[k][I_NOW]);
                var futCodePart = collapseSubcodesToString(parts[k][I_FUTURE]);
                
                if (nowCodePart == futCodePart) {
                    // Don't include the "future" code if it's the same as the "now" code
                    futCodePart = '';
                }
                
                if (futCodePart) {
                    futCodePart = ">" + futCodePart;
                }
                
                codePart = k + nowCodePart + futCodePart;
            }
            
            // Then, if the prefix either has a modifier code or is allowed to exist on its own...
            if (!(codePart.length == 1 && codesThatMakeNoSenseAlone.indexOf(codePart) != -1)) {
                // ... add it to the output code
                code += codePart + " ";
            }
        }
        
        // Remove the trailing space and show it in the output box
        code = code.substring(0, code.length - 1);
        $('#output').val(code);
    }
    
    // Update the displayed code whenever the input changes
    $('.inner :radio, .inner :checkbox, .inner input[type=text]').change(function(){
        updateCodeDisplay();
    });
    
    // Select all of the output code when the field is focused
    $('#output').bind('focus mouseup', function(e) {
        if (e.type == 'focus') {
            this.select();
        }
        if (e.type == 'mouseup') {
            return false;
        }
    });
    
    $('h2 .sechead[id]').each(function(){
        var groupClass = $(this).closest('.human').length > 0 ? 'human' : 'furry';
        $('#jumpto .'+groupClass).append($("<option>").attr('value', this.id).text("[" + this.id + "] " + $(this).text()));
    });
    $('#jumpto').bind('change click keyup', function(){
        var val = $(this).val();
        if (val.length && val != $(this).data('prevval')) {
            $(this).data('prevval', val);
            $('#'+$(this).val())[0].scrollIntoView();
            window.scrollBy(0, -50);
        }
    });
    
    $('input[type=text]').focus(function(){
        $(':radio[name="'+this.name+'"]').prop('checked', true).button('refresh').change();
    });
});
</script>
</head>
<body>
<nav>
<label for="jumpto">Jump To Section:</label>
<select id="jumpto">
<option> -- Select One -- </option>
<optgroup class="furry" label="Your Furry Side"></optgroup>
<optgroup class="human" label="Your Human Side"></optgroup>
</select>
</nav>
<header>
<h1><a href="">Fur Code Generator</a></h1>
<p><em>Based on the Fur Code documentation at <a href="furry/furcode.htm">http://captainpackrat.com/furry/furcode.htm</a>.</em></p>
<p><em>See also the <a href="wiki/Furry_code.html">WikiFur article on the Furry Code</a>.</em></p>
<p><em>Here is a <a href="furcode.html">FurCode Decoder</a></em>.</p>
</header>
<div class="outer furry">
<h1>Your Furry Side</h1>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="F">Furry Species</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="F[now][opt]" value="" data-clear="1">
<input type="radio" name="F[now][opt]" value="?">
<input type="radio" name="F[now][opt]" value="~">
<input type="radio" name="F[now][opt]" value="!">
<input type="radio" name="F[now][opt]" value="#">
</span>
<input type="checkbox" name="F[now][opt]" value="$" disabled="">
</span>
</h2>
<section>
<p>Этот код указывает, к какому виду относится ваш пушистый персонаж. Вы можете указать свой точный вид или просто общий тип, если ваша личная пушистость не вписывается в конкретный вид.</p>
<p>Есть тонкая разница между использованием «общих» кодов и использованием "?" модификатор. Например, "FC" означает, что вы собака, но не подходите ни к одному из известных видов, а "FC?" означает, что вы еще не решили, к какому именно типу собак вы относитесь. Аналогично "F?" означает, что вы не знаете, какой вы пушистый, в то время как "FG" означает, что у вас есть определенная форма, но это просто своего рода «общий пушистый», а не какой-то конкретный вид.</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th>Семейство</th>
<th>Вид</th>
</tr>
<tr>
<th><input type="radio" name="F[now]" value=""></th>
<th><input type="radio" name="F[fut]" value=""></th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="F[now]" value="G" title="FG"></td>
<td></td>
<th colspan="2"><em>Generic Furry</em></th>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="A" title="FA"></td>
<td><input type="radio" name="F[fut]" value="A" title="FA"></td>
<th rowspan="14">Птичий</th>
<td><em>Общий / Не указано</em></td>
</tr>
 <tr>
<td><input type="radio" name="F[now]" value="A" data-custom="1" title="FA[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="A" data-custom="1" title="FA[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="AA" title="FAA"></td>
<td><input type="radio" name="F[fut]" value="AA" title="FAA"></td>
<td>Albatross</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="AD" title="FAD"></td>
<td><input type="radio" name="F[fut]" value="AD" title="FAD"></td>
<td>Утка</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="AE" title="FAE"></td>
<td><input type="radio" name="F[fut]" value="AE" title="FAE"></td>
<td>Eagle</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="AF" title="FAF"></td>
<td><input type="radio" name="F[fut]" value="AF" title="FAF"></td>
<td>Falcon</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="AG" title="FAG"></td>
<td><input type="radio" name="F[fut]" value="AG" title="FAG"></td>
<td>Seagull</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="AH" title="FAH"></td>
<td><input type="radio" name="F[fut]" value="AH" title="FAH"></td>
<td>Hawk</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="AK" title="FAK"></td>
<td><input type="radio" name="F[fut]" value="AK" title="FAK"></td>
<td>Kiwi</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="AO" title="FAO"></td>
<td><input type="radio" name="F[fut]" value="AO" title="FAO"></td>
<td>Owl</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="AR" title="FAR"></td>
<td><input type="radio" name="F[fut]" value="AR" title="FAR"></td>
<td>Raven</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="AS" title="FAS"></td>
<td><input type="radio" name="F[fut]" value="AS" title="FAS"></td>
<td>Sparrow</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="AW" title="FAW"></td>
<td><input type="radio" name="F[fut]" value="AW" title="FAW"></td>
<td>Wren</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Ar" title="FAr"></td>
<td><input type="radio" name="F[fut]" value="Ar" title="FAr"></td>
<th rowspan="18"><em>Artiodactyla</em> (two-toed hoofed animals)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Ar" data-custom="1" title="FAr[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="Ar" data-custom="1" title="FAr[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ArA" title="FArA"></td>
<td><input type="radio" name="F[fut]" value="ArA" title="FArA"></td>
<td>Antelope</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ArB" title="FArB"></td>
<td><input type="radio" name="F[fut]" value="ArB" title="FArB"></td>
<td>Buffalo</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ArC" title="FArC"></td>
<td><input type="radio" name="F[fut]" value="ArC" title="FArC"></td>
<td>Cattle</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ArD" title="FArD"></td>
<td><input type="radio" name="F[fut]" value="ArD" title="FArD"></td>
<td>Deer</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ArE" title="FArE"></td>
<td><input type="radio" name="F[fut]" value="ArE" title="FArE"></td>
<td>Camel</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ArF" title="FArF"></td>
<td><input type="radio" name="F[fut]" value="ArF" title="FArF"></td>
<td>Giraffe</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ArG" title="FArG"></td>
<td><input type="radio" name="F[fut]" value="ArG" title="FArG"></td>
<td>Goat</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ArL" title="FArL"></td>
<td><input type="radio" name="F[fut]" value="ArL" title="FArL"></td>
<td>Llama</td>
</tr>
 <tr>
<td><input type="radio" name="F[now]" value="ArM" title="FArM"></td>
<td><input type="radio" name="F[fut]" value="ArM" title="FArM"></td>
<td>Moose</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ArN" title="FArN"></td>
<td><input type="radio" name="F[fut]" value="ArN" title="FArN"></td>
<td>Gnu</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ArP" title="FArP"></td>
<td><input type="radio" name="F[fut]" value="ArP" title="FArP"></td>
<td>Pig</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ArR" title="FArR"></td>
<td><input type="radio" name="F[fut]" value="ArR" title="FArR"></td>
<td>Reindeer</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ArS" title="FArS"></td>
<td><input type="radio" name="F[fut]" value="ArS" title="FArS"></td>
<td>Sheep</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ArW" title="FArW"></td>
<td><input type="radio" name="F[fut]" value="ArW" title="FArW"></td>
<td>Warthog</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ArZ" title="FArZ"></td>
<td><input type="radio" name="F[fut]" value="ArZ" title="FArZ"></td>
<td>Gazelle</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="C" title="FC"></td>
<td><input type="radio" name="F[fut]" value="C" title="FC"></td>
<th rowspan="11"><em>Canidae</em> (dog family)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="C" data-custom="1" title="FC[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="C" data-custom="1" title="FC[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="CA" title="FCA"></td>
<td><input type="radio" name="F[fut]" value="CA" title="FCA"></td>
<td>Arctic fox</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="CC" title="FCC"></td>
<td><input type="radio" name="F[fut]" value="CC" title="FCC"></td>
<td>Coyote</td>
</tr>
 <tr>
<td><input type="radio" name="F[now]" value="CD" title="FCD"></td>
<td><input type="radio" name="F[fut]" value="CD" title="FCD"></td>
<td>Dingo</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="CF" title="FCF"></td>
<td><input type="radio" name="F[fut]" value="CF" title="FCF"></td>
<td>Fox</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="CJ" title="FCJ"></td>
<td><input type="radio" name="F[fut]" value="CJ" title="FCJ"></td>
<td>Jackal</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="CM" title="FCM"></td>
<td><input type="radio" name="F[fut]" value="CM" title="FCM"></td>
<td>Domestic mutt</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="CW" title="FCW"></td>
<td><input type="radio" name="F[fut]" value="CW" title="FCW"></td>
<td>Wolf</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="CX" title="FCX"></td>
<td><input type="radio" name="F[fut]" value="CX" title="FCX"></td>
<td>Maned wolf</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Ce" title="FCe"></td>
<td><input type="radio" name="F[fut]" value="Ce" title="FCe"></td>
<th rowspan="5">Centaurs</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Ce" data-custom="1" title="FCe[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="Ce" data-custom="1" title="FCe[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="CeH" title="FCeH"></td>
<td><input type="radio" name="F[fut]" value="CeH" title="FCeH"></td>
<td>Common (horse-human) centaur</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="CeZ" title="FCeZ"></td>
<td><input type="radio" name="F[fut]" value="CeZ" title="FCeZ"></td>
<td> Zebra-centaur</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Ch" title="FCh"></td>
<td><input type="radio" name="F[fut]" value="Ch" title="FCh"></td>
<th rowspan="5"><em>Chiroptera</em> (bat family)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Ch" data-custom="1" title="FCh[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="Ch" data-custom="1" title="FCh[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ChF" title="FChF"></td>
<td><input type="radio" name="F[fut]" value="ChF" title="FChF"></td>
<td>Flying fox or fruit bat</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ChV" title="FChV"></td>
<td><input type="radio" name="F[fut]" value="ChV" title="FChV"></td>
<td>Vampire bat</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Ct" title="FCt"></td>
<td><input type="radio" name="F[fut]" value="Ct" title="FCt"></td>
<th rowspan="4"><em>Cetacea</em> (whale family)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Ct" data-custom="1" title="FCt[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="Ct" data-custom="1" title="FCt[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="CtD" title="FCtD"></td>
<td><input type="radio" name="F[fut]" value="CtD" title="FCtD"></td>
<td>Dolphin</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="D" title="FD"></td>
<td><input type="radio" name="F[fut]" value="D" title="FD"></td>
<th rowspan="10">Dragons, dinosaurs, and other reptiles</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="D" data-custom="1" title="FD[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="D" data-custom="1" title="FD[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="DA" title="FDA"></td>
<td><input type="radio" name="F[fut]" value="DA" title="FDA"></td>
<td>Alligator or crocodile</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="DC" title="FDC"></td>
<td><input type="radio" name="F[fut]" value="DC" title="FDC"></td>
<td>Coelurosaur (Velociraptor etc)</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="DD" title="FDD"></td>
<td><input type="radio" name="F[fut]" value="DD" title="FDD"></td>
<td>Dragon</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="DK" title="FDK"></td>
<td><input type="radio" name="F[fut]" value="DK" title="FDK"></td>
<td>Carnosaur (Tyrannosaurus etc)</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="DL" title="FDL"></td>
<td><input type="radio" name="F[fut]" value="DL" title="FDL"></td>
<td>Lizard</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="DS" title="FDS"></td>
<td><input type="radio" name="F[fut]" value="DS" title="FDS"></td>
<td>Snake</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="DT" title="FDT"></td>
<td><input type="radio" name="F[fut]" value="DT" title="FDT"></td>
<td>Tortoise or turtle</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="E" title="FE"></td>
<td><input type="radio" name="F[fut]" value="E" title="FE"></td>
<th rowspan="6"><em>Equidae</em> (horse family)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="E" data-custom="1" title="FE[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="E" data-custom="1" title="FE[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ED" title="FED"></td>
<td><input type="radio" name="F[fut]" value="ED" title="FED"></td>
<td>Donkey</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="EH" title="FEH"></td>
<td><input type="radio" name="F[fut]" value="EH" title="FEH"></td>
<td>Horse</td>
</tr>
 <tr>
<td><input type="radio" name="F[now]" value="EZ" title="FEZ"></td>
<td><input type="radio" name="F[fut]" value="EZ" title="FEZ"></td>
<td>Zebra</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Ed" title="FEd"></td>
<td><input type="radio" name="F[fut]" value="Ed" title="FEd"></td>
<th rowspan="6"><em>Edentata</em></th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Ed" data-custom="1" title="FEd[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="Ed" data-custom="1" title="FEd[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="EdA" title="FEdA"></td>
<td><input type="radio" name="F[fut]" value="EdA" title="FEdA"></td>
<td>Anteater</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="EdR" title="FEdR"></td>
<td><input type="radio" name="F[fut]" value="EdR" title="FEdR"></td>
<td>Armadillo</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="EdS" title="FEdS"></td>
<td><input type="radio" name="F[fut]" value="EdS" title="FEdS"></td>
<td>Sloth</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="F" title="FF"></td>
<td><input type="radio" name="F[fut]" value="F" title="FF"></td>
<th rowspan="17"><em>Felidae</em> (cat family)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="F" data-custom="1" title="FF[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="F" data-custom="1" title="FF[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="FB" title="FFB"></td>
<td><input type="radio" name="F[fut]" value="FB" title="FFB"></td>
<td>Bobcat</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="FC" title="FFC"></td>
<td><input type="radio" name="F[fut]" value="FC" title="FFC"></td>
<td>Clouded leopard</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="FD" title="FFD"></td>
<td><input type="radio" name="F[fut]" value="FD" title="FFD"></td>
<td>Domestic cat</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="FH" title="FFH"></td>
<td><input type="radio" name="F[fut]" value="FH" title="FFH"></td>
<td>Cheetah</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="FJ" title="FFJ"></td>
<td><input type="radio" name="F[fut]" value="FJ" title="FFJ"></td>
<td>Jaguar</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="FL" title="FFL"></td>
<td><input type="radio" name="F[fut]" value="FL" title="FFL"></td>
<td>Lion</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="FM" title="FFM"></td>
<td><input type="radio" name="F[fut]" value="FM" title="FFM"></td>
<td>Puma/cougar/mountain lion</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="FO" title="FFO"></td>
<td><input type="radio" name="F[fut]" value="FO" title="FFO"></td>
<td>Ocelot</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="FP" title="FFP"></td>
<td><input type="radio" name="F[fut]" value="FP" title="FFP"></td>
<td>Leopard/panther</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="FS" title="FFS"></td>
<td><input type="radio" name="F[fut]" value="FS" title="FFS"></td>
<td>Snow leopard</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="FT" title="FFT"></td>
<td><input type="radio" name="F[fut]" value="FT" title="FFT"></td>
<td>Tiger</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="FV" title="FFV"></td>
<td><input type="radio" name="F[fut]" value="FV" title="FFV"></td>
<td>Serval</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="FW" title="FFW"></td>
<td><input type="radio" name="F[fut]" value="FW" title="FFW"></td>
<td>Wild cat</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="FX" title="FFX"></td>
<td><input type="radio" name="F[fut]" value="FX" title="FFX"></td>
<td>Lynx</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="G" title="FG"></td>
<td><input type="radio" name="F[fut]" value="G" title="FG"></td>
<th rowspan="3">Generic furry</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="G" data-custom="1" title="FG[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="G" data-custom="1" title="FG[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="H" title="FH"></td>
<td><input type="radio" name="F[fut]" value="H" title="FH"></td>
<th rowspan="5"><em>Herpestidae</em> (mongoose family)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="H" data-custom="1" title="FH[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="H" data-custom="1" title="FH[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="HK" title="FHK"></td>
<td><input type="radio" name="F[fut]" value="HK" title="FHK"></td>
<td>Meerkat</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="HM" title="FHM"></td>
<td><input type="radio" name="F[fut]" value="HM" title="FHM"></td>
<td>Mongoose</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Hy" title="FHy"></td>
<td><input type="radio" name="F[fut]" value="Hy" title="FHy"></td>
<th rowspan="4"><em>Hyaenidae</em> (hyena family)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Hy" data-custom="1" title="FHy[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="Hy" data-custom="1" title="FHy[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="HyH" title="FHyH"></td>
 <td><input type="radio" name="F[fut]" value="HyH" title="FHyH"></td>
<td>Hyena</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="I" title="FI"></td>
<td><input type="radio" name="F[fut]" value="I" title="FI"></td>
<th rowspan="5"><em>Insectivora</em></th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="I" data-custom="1" title="FI[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="I" data-custom="1" title="FI[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="IH" title="FIH"></td>
<td><input type="radio" name="F[fut]" value="IH" title="FIH"></td>
<td>Hedgehog</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="IM" title="FIM"></td>
<td><input type="radio" name="F[fut]" value="IM" title="FIM"></td>
<td>Mole</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="L" title="FL"></td>
<td><input type="radio" name="F[fut]" value="L" title="FL"></td>
<th rowspan="6"><em>Lagomorpha</em> (rabbit family)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="L" data-custom="1" title="FL[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="L" data-custom="1" title="FL[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="LH" title="FLH"></td>
<td><input type="radio" name="F[fut]" value="LH" title="FLH"></td>
<td>Hare</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="LJ" title="FLJ"></td>
<td><input type="radio" name="F[fut]" value="LJ" title="FLJ"></td>
<td>Jackrabbit</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="LR" title="FLR"></td>
<td><input type="radio" name="F[fut]" value="LR" title="FLR"></td>
<td>Rabbit</td>
</tr>
<tr>
 <td><input type="radio" name="F[now]" value="M" title="FM"></td>
<td><input type="radio" name="F[fut]" value="M" title="FM"></td>
<th rowspan="15"><em>Mustelidae</em> (weasel family)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="M" data-custom="1" title="FM[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="M" data-custom="1" title="FM[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MA" title="FMA"></td>
<td><input type="radio" name="F[fut]" value="MA" title="FMA"></td>
<td>Sable</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MB" title="FMB"></td>
<td><input type="radio" name="F[fut]" value="MB" title="FMB"></td>
<td>Badger</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="ME" title="FME"></td>
<td><input type="radio" name="F[fut]" value="ME" title="FME"></td>
<td>Ermine/stoat</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MF" title="FMF"></td>
<td><input type="radio" name="F[fut]" value="MF" title="FMF"></td>
<td>Ferret</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MK" title="FMK"></td>
<td><input type="radio" name="F[fut]" value="MK" title="FMK"></td>
<td>Mink</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MM" title="FMM"></td>
<td><input type="radio" name="F[fut]" value="MM" title="FMM"></td>
<td>Marten</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MO" title="FMO"></td>
<td><input type="radio" name="F[fut]" value="MO" title="FMO"></td>
<td>Otter</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MP" title="FMP"></td>
<td><input type="radio" name="F[fut]" value="MP" title="FMP"></td>
<td>Polecat</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MR" title="FMR"></td>
<td><input type="radio" name="F[fut]" value="MR" title="FMR"></td>
<td>Ratel/honey badger</td>
</tr>
<tr>
 <td><input type="radio" name="F[now]" value="MS" title="FMS"></td>
<td><input type="radio" name="F[fut]" value="MS" title="FMS"></td>
<td>Skunk</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MV" title="FMV"></td>
<td><input type="radio" name="F[fut]" value="MV" title="FMV"></td>
<td>Wolverine</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MW" title="FMW"></td>
<td><input type="radio" name="F[fut]" value="MW" title="FMW"></td>
<td>Weasel</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Ma" title="FMa"></td>
<td><input type="radio" name="F[fut]" value="Ma" title="FMa"></td>
<th rowspan="9"><em>Marsupialia</em></th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Ma" data-custom="1" title="FMa[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="Ma" data-custom="1" title="FMa[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MaB" title="FMaB"></td>
<td><input type="radio" name="F[fut]" value="MaB" title="FMaB"></td>
<td>Wombat</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MaK" title="FMaK"></td>
<td><input type="radio" name="F[fut]" value="MaK" title="FMaK"></td>
<td>Kangaroo</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MaO" title="FMaO"></td>
<td><input type="radio" name="F[fut]" value="MaO" title="FMaO"></td>
<td>Koala</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MaP" title="FMaP"></td>
<td><input type="radio" name="F[fut]" value="MaP" title="FMaP"></td>
<td>Possum</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MaT" title="FMaT"></td>
<td><input type="radio" name="F[fut]" value="MaT" title="FMaT"></td>
<td>Tasmanian devil</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MaW" title="FMaW"></td>
<td><input type="radio" name="F[fut]" value="MaW" title="FMaW"></td>
<td>Wallaby</td>
</tr>
 <tr>
<td><input type="radio" name="F[now]" value="Mo" title="FMo"></td>
<td><input type="radio" name="F[fut]" value="Mo" title="FMo"></td>
<th rowspan="4"><em>Monotremata</em></th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Mo" data-custom="1" title="FMo[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="Mo" data-custom="1" title="FMo[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="MoP" title="FMoP"></td>
<td><input type="radio" name="F[fut]" value="MoP" title="FMoP"></td>
<td>Platypus</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="P" title="FP"></td>
<td><input type="radio" name="F[fut]" value="P" title="FP"></td>
<th rowspan="4"><em>Procyonidae</em> (raccoon family)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="P" data-custom="1" title="FP[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="P" data-custom="1" title="FP[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="PR" title="FPR"></td>
<td><input type="radio" name="F[fut]" value="PR" title="FPR"></td>
<td>Raccoon</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Pi" title="FPi"></td>
<td><input type="radio" name="F[fut]" value="Pi" title="FPi"></td>
<th rowspan="6"><em>Pinnipedia</em> (seal family)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Pi" data-custom="1" title="FPi[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="Pi" data-custom="1" title="FPi[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="PiL" title="FPiL"></td>
<td><input type="radio" name="F[fut]" value="PiL" title="FPiL"></td>
<td>Sea lion</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="PiS" title="FPiS"></td>
<td><input type="radio" name="F[fut]" value="PiS" title="FPiS"></td>
<td>Seal</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="PiW" title="FPiW"></td>
<td><input type="radio" name="F[fut]" value="PiW" title="FPiW"></td>
<td>Walrus</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Pr" title="FPr"></td>
<td><input type="radio" name="F[fut]" value="Pr" title="FPr"></td>
<th rowspan="4"><em>Primates</em></th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Pr" data-custom="1" title="FPr[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="Pr" data-custom="1" title="FPr[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="PrL" title="FPrL"></td>
<td><input type="radio" name="F[fut]" value="PrL" title="FPrL"></td>
<td>Lemur</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="R" title="FR"></td>
<td><input type="radio" name="F[fut]" value="R" title="FR"></td>
<th rowspan="10"><em>Rodentia</em></th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="R" data-custom="1" title="FR[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="R" data-custom="1" title="FR[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="RB" title="FRB"></td>
<td><input type="radio" name="F[fut]" value="RB" title="FRB"></td>
<td>Beaver</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="RG" title="FRG"></td>
<td><input type="radio" name="F[fut]" value="RG" title="FRG"></td>
<td>Grey squirrel</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="RM" title="FRM"></td>
<td><input type="radio" name="F[fut]" value="RM" title="FRM"></td>
<td>Mouse</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="RP" title="FRP"></td>
<td><input type="radio" name="F[fut]" value="RP" title="FRP"></td>
<td>Porcupine</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="RR" title="FRR"></td>
<td><input type="radio" name="F[fut]" value="RR" title="FRR"></td>
<td>Rat</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="RS" title="FRS"></td>
<td><input type="radio" name="F[fut]" value="RS" title="FRS"></td>
<td>Red squirrel</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="RU" title="FRU"></td>
<td><input type="radio" name="F[fut]" value="RU" title="FRU"></td>
<td>Muskrat</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="U" title="FU"></td>
<td><input type="radio" name="F[fut]" value="U" title="FU"></td>
<th rowspan="7"><em>Ursidae</em> (bear family)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="U" data-custom="1" title="FU[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="U" data-custom="1" title="FU[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="UA" title="FUA"></td>
<td><input type="radio" name="F[fut]" value="UA" title="FUA"></td>
<td>Polar bear</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="UB" title="FUB"></td>
<td><input type="radio" name="F[fut]" value="UB" title="FUB"></td>
<td>Black bear</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="UG" title="FUG"></td>
<td><input type="radio" name="F[fut]" value="UG" title="FUG"></td>
<td>Grizzly bear/brown bear/Kodiak bear</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="UP" title="FUP"></td>
<td><input type="radio" name="F[fut]" value="UP" title="FUP"></td>
<td>Giant panda</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="V" title="FV"></td>
<td><input type="radio" name="F[fut]" value="V" title="FV"></td>
<th rowspan="4"><em>Viverridae</em> (civet family)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="V" data-custom="1" title="FV[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="V" data-custom="1" title="FV[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="VC" title="FVC"></td>
<td><input type="radio" name="F[fut]" value="VC" title="FVC"></td>
<td>Civet</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="X" title="FX"></td>
<td><input type="radio" name="F[fut]" value="X" title="FX"></td>
<th rowspan="8">Mythical creatures (other than centaurs and dragons)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="X" data-custom="1" title="FX[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="X" data-custom="1" title="FX[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="XA" title="FXA"></td>
<td><input type="radio" name="F[fut]" value="XA" title="FXA"></td>
<td>Gargoyle</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="XC" title="FXC"></td>
<td><input type="radio" name="F[fut]" value="XC" title="FXC"></td>
<td>Manticore</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="XG" title="FXG"></td>
<td><input type="radio" name="F[fut]" value="XG" title="FXG"></td>
<td>Gryphon</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="XH" title="FXH"></td>
<td><input type="radio" name="F[fut]" value="XH" title="FXH"></td>
<td>Hippogriff</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="XM" title="FXM"></td>
<td><input type="radio" name="F[fut]" value="XM" title="FXM"></td>
<td>Mermaid/merman</td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Z" title="FZ"></td>
<td><input type="radio" name="F[fut]" value="Z" title="FZ"></td>
<th rowspan="3">Polymorph (you change shape at will, with no "normal" shape)</th>
<td><em>Generic/Unspecified</em></td>
</tr>
<tr>
<td><input type="radio" name="F[now]" value="Z" data-custom="1" title="FZ[…]"></td>
<td></td>
<td><input type="text" name="F[now]" placeholder="Custom Species (Now)"></td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="F[fut]" value="Z" data-custom="1" title="FZ[…]"></td>
<td><input type="text" name="F[fut]" placeholder="Custom Species (Future)"></td>
</tr>
</tbody>
</table>
<h3>Variation Modifiers</h3>
<p>After identifying your basic furry species, one or more modifiers may be added to indicate variations on the theme:</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th>Variation</th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="checkbox" name="F[now][mod][0][]" value="c" title="c"></td>
<td><input type="checkbox" name="F[fut][mod][0][]" value="c" title="c"></td>
<td>Cyborg</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][0][]" value="f" title="f"></td>
<td><input type="checkbox" name="F[fut][mod][0][]" value="f" title="f"></td>
<td>"Funny animal" (toon)</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][0][]" value="h" title="h"></td>
<td><input type="checkbox" name="F[fut][mod][0][]" value="h" title="h"></td>
<td>Were-human</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][0][]" value="m" title="m"></td>
<td><input type="checkbox" name="F[fut][mod][0][]" value="m" title="m"></td>
<td>Magical powers (other than those covered by other codes)</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][0][]" value="p" title="p"></td>
<td><input type="checkbox" name="F[fut][mod][0][]" value="p" title="p"></td>
<td>Polymorph (the given species is your normal form, but you can change shape)</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][0][]" value="s" title="s"></td>
<td><input type="checkbox" name="F[fut][mod][0][]" value="s" title="s"></td>
<td>Psychic powers</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][0][]" value="t" title="t"></td>
<td><input type="checkbox" name="F[fut][mod][0][]" value="t" title="t"></td>
<td>Taur</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][0][]" value="u" title="u"></td>
<td><input type="checkbox" name="F[fut][mod][0][]" value="u" title="u"></td>
<td>Unicorn</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][0][]" value="w" title="w"></td>
<td><input type="checkbox" name="F[fut][mod][0][]" value="w" title="w"></td>
<td>Winged (if the species is not normally winged)</td>
</tr>
</tbody>
</table>
<p>For the purposes of the Furry Code, a "taur" is a variation on the animal theme, while a "centaur" is half-human, half-animal (and is counted as a species in its own right). If you have the upper body of a human and the lower body of a zebra, you're a zebra-centaur and your code is <em>FCeZ</em>, while if you look like a zebra all over, but with four legs and two arms, you're a zebra-taur and your code is <em>FEZt</em>.</p>
<h3>Human-to-Animal Scale</h3>
<p>Next, add a number to indicate where you fall on the human-to-animal scale:</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th>Variation</th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="checkbox" name="F[now][mod][1][]" value="1" title="1"></td>
<td><input type="checkbox" name="F[fut][mod][1][]" value="1" title="1"></td>
<td>Basically human, with minor furry features (perhaps eyes, nose, ears, claws, some fur, etc)</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][1][]" value="2" title="2"></td>
<td><input type="checkbox" name="F[fut][mod][1][]" value="2" title="2"></td>
<td>Humanoid, with significant furry features (muzzle, tail, etc); this includes centaurs and mer-people</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][1][]" value="3" title="3"></td>
<td><input type="checkbox" name="F[fut][mod][1][]" value="3" title="3"></td>
<td>Anthropomorphic animal (or taur)</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][1][]" value="4" title="4"></td>
<td><input type="checkbox" name="F[fut][mod][1][]" value="4" title="4"></td>
<td>Equally comfortable on two or four legs (or, if you're a taur, on four or six)</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][1][]" value="5" title="5"></td>
<td><input type="checkbox" name="F[fut][mod][1][]" value="5" title="5"></td>
<td>Animal shape, with some unusual features (perhaps hands, speech, etc); this includes most dragons, gryphons, etc</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][1][]" value="6" title="6"></td>
<td><input type="checkbox" name="F[fut][mod][1][]" value="6" title="6"></td>
<td>Normal animal shape</td>
</tr>
</tbody>
</table>
<h3>Character Type</h3>
<p>Finally, add one or more letters after the number to indicate what your relationship is with your personal furry.</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th>Variation</th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="checkbox" name="F[now][mod][2][]" value="a" title="a"></td>
<td><input type="checkbox" name="F[fut][mod][2][]" value="a" title="a"></td>
<td>Just a general "alter ego"</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][2][]" value="c" title="c"></td>
<td><input type="checkbox" name="F[fut][mod][2][]" value="c" title="c"></td>
<td>A costume I wear</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][2][]" value="d" title="d"></td>
<td><input type="checkbox" name="F[fut][mod][2][]" value="d" title="d"></td>
<td>Someone to draw pictures of</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][2][]" value="f" title="f"></td>
<td><input type="checkbox" name="F[fut][mod][2][]" value="f" title="f"></td>
<td>Imaginary friend</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][2][]" value="m" title="m"></td>
<td><input type="checkbox" name="F[fut][mod][2][]" value="m" title="m"></td>
<td>Online MU* character (FurryMuck etc)</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][2][]" value="r" title="r"></td>
<td><input type="checkbox" name="F[fut][mod][2][]" value="r" title="r"></td>
<td>Role-playing game character</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][2][]" value="s" title="s"></td>
<td><input type="checkbox" name="F[fut][mod][2][]" value="s" title="s"></td>
<td>Guardian spirit or totem</td>
</tr>
<tr>
<td><input type="checkbox" name="F[now][mod][2][]" value="w" title="w"></td>
<td><input type="checkbox" name="F[fut][mod][2][]" value="w" title="w"></td>
<td>Someone to write stories about</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="A">Art</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="A[now][opt]" value="" data-clear="1">
<input type="radio" name="A[now][opt]" value="?">
<input type="radio" name="A[now][opt]" value="~">
<input type="radio" name="A[now][opt]" value="!">
<input type="radio" name="A[now][opt]" value="#">
</span>
<input type="checkbox" name="A[now][opt]" value="$">
</span>
</h2>
<section>
<p>Most furry fans try their paw at furry artwork sooner or later.</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="A[now]" value=""></th>
<th><input type="radio" name="A[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="A[now]" value="++++" title="A++++"></td>
<td><input type="radio" name="A[fut]" value="++++" title="A++++"></td>
<td>Art is my life</td>
</tr>
<tr>
<td><input type="radio" name="A[now]" value="+++" title="A+++"></td>
<td><input type="radio" name="A[fut]" value="+++" title="A+++"></td>
<td>My art appears regularly in zines and elsewhere, and people ask me to contribute to their sketchbooks</td>
</tr>
<tr>
<td><input type="radio" name="A[now]" value="++" title="A++"></td>
<td><input type="radio" name="A[fut]" value="++" title="A++"></td>
<td>I have pictures in reasonably well-known zines and/or Web sites</td>
</tr>
<tr>
<td><input type="radio" name="A[now]" value="+" title="A+"></td>
<td><input type="radio" name="A[fut]" value="+" title="A+"></td>
<td>I draw regularly, and someone once said something that could possibly be construed as a compliment</td>
</tr>
<tr>
<td><input type="radio" name="A[now]" value=" " title="A "></td>
<td><input type="radio" name="A[fut]" value=" " title="A "></td>
<td>I've shown one or two of my pictures to others, and they didn't actually throw up</td>
</tr>
<tr>
<td><input type="radio" name="A[now]" value="-" title="A-"></td>
<td><input type="radio" name="A[fut]" value="-" title="A-"></td>
<td>Tried a few sketches in the privacy of my own home</td>
</tr>
<tr>
<td><input type="radio" name="A[now]" value="--" title="A--"></td>
<td><input type="radio" name="A[fut]" value="--" title="A--"></td>
<td>Never tried</td>
</tr>
<tr>
<td><input type="radio" name="A[now]" value="---" title="A---"></td>
<td><input type="radio" name="A[fut]" value="---" title="A---"></td>
<td>Never tried, never will</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="C">Conventions</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="C[now][opt]" value="" data-clear="1">
<input type="radio" name="C[now][opt]" value="?">
<input type="radio" name="C[now][opt]" value="~">
<input type="radio" name="C[now][opt]" value="!">
<input type="radio" name="C[now][opt]" value="#">
</span>
<input type="checkbox" name="C[now][opt]" value="$">
</span>
</h2>
<section>
<p>How often do you go to/get involved in/get thrown out of furry conventions? (Note: this category, except as noted below, refers specifically to <em>furry</em> cons, not to SF-related cons in general.)</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="C[now]" value=""></th>
<th><input type="radio" name="C[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="C[now]" value="+++" title="C+++"></td>
<td><input type="radio" name="C[fut]" value="+++" title="C+++"></td>
<td>Been to lots of cons, organised at least one</td>
</tr>
<tr>
<td><input type="radio" name="C[now]" value="++" title="C++"></td>
<td><input type="radio" name="C[fut]" value="++" title="C++"></td>
<td>I'm a regular con-goer, and I've occasionally lent a paw</td>
</tr>
<tr>
<td><input type="radio" name="C[now]" value="+" title="C+"></td>
<td><input type="radio" name="C[fut]" value="+" title="C+"></td>
<td>I've been to several, and plan to go to many more</td>
</tr>
<tr>
<td><input type="radio" name="C[now]" value=" " title="C "></td>
<td><input type="radio" name="C[fut]" value=" " title="C "></td>
<td>I've been to one</td>
</tr>
<tr>
<td><input type="radio" name="C[now]" value="-" title="C-"></td>
<td><input type="radio" name="C[fut]" value="-" title="C-"></td>
<td>Never been to one, but may do so in future</td>
</tr>
<tr>
<td><input type="radio" name="C[now]" value="--" title="C--"></td>
<td><input type="radio" name="C[fut]" value="--" title="C--"></td>
<td>Not interested</td>
</tr>
<tr>
<td><input type="radio" name="C[now]" value="---" title="C---"></td>
<td><input type="radio" name="C[fut]" value="---" title="C---"></td>
<td>I wouldn't go near one of those places if you paid me</td>
</tr>
<tr>
<td><input type="radio" name="C[now]" value="*" title="C*"></td>
 <td><input type="radio" name="C[fut]" value="*" title="C*"></td>
<td>Haven't been to a furry con, but I have been to an SF con</td>
</tr>
<tr>
<td><input type="radio" name="C[now]" value="**" title="C**"></td>
<td><input type="radio" name="C[fut]" value="**" title="C**"></td>
<td>Haven't been to a furry con, but I've helped organise an SF con</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="D">Dressing up</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="D[now][opt]" value="" data-clear="1">
<input type="radio" name="D[now][opt]" value="?">
<input type="radio" name="D[now][opt]" value="~">
<input type="radio" name="D[now][opt]" value="!">
<input type="radio" name="D[now][opt]" value="#">
</span>
<input type="checkbox" name="D[now][opt]" value="$">
</span>
</h2>
<section>
<p>Many furries are into cross-dressing. Cross-species, that is.</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="D[now]" value=""></th>
<th><input type="radio" name="D[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="D[now]" value="++++" title="D++++"></td>
<td><input type="radio" name="D[fut]" value="++++" title="D++++"></td>
<td>I've made plans to be buried in a fursuit</td>
</tr>
<tr>
<td><input type="radio" name="D[now]" value="+++" title="D+++"></td>
<td><input type="radio" name="D[fut]" value="+++" title="D+++"></td>
<td>I'll wear a fursuit at any opportunity (where costumes are not expected)</td>
</tr>
<tr>
<td><input type="radio" name="D[now]" value="++" title="D++"></td>
<td><input type="radio" name="D[fut]" value="++" title="D++"></td>
<td>I'll wear a fursuit at cons/sporting events (where costumes are uncommon)</td>
</tr>
<tr>
<td><input type="radio" name="D[now]" value="+" title="D+"></td>
<td><input type="radio" name="D[fut]" value="+" title="D+"></td>
<td>I'll wear a fursuit for Halloween/masquerades (where costumes are expected)</td>
</tr>
<tr>
<td><input type="radio" name="D[now]" value=" " title="D "></td>
<td><input type="radio" name="D[fut]" value=" " title="D "></td>
<td>I might wear a fursuit</td>
</tr>
<tr>
<td><input type="radio" name="D[now]" value="-" title="D-"></td>
 <td><input type="radio" name="D[fut]" value="-" title="D-"></td>
<td>I'd wear a fursuit if I had to</td>
</tr>
<tr>
<td><input type="radio" name="D[now]" value="--" title="D--"></td>
<td><input type="radio" name="D[fut]" value="--" title="D--"></td>
<td>You must be kidding, I'd die first</td>
</tr>
</tbody>
</table>
<p>And a little extra...</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="checkbox" name="D[now][pmod]" value="m" title="Dm"></td>
<td><input type="checkbox" name="D[fut][pmod]" value="m" title="Dm"></td>
<td>I've made my own fursuit!</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="H">Hugs</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="H[now][opt]" value="" data-clear="1">
<input type="radio" name="H[now][opt]" value="?">
<input type="radio" name="H[now][opt]" value="~">
<input type="radio" name="H[now][opt]" value="!">
<input type="radio" name="H[now][opt]" value="#">
</span>
<input type="checkbox" name="H[now][opt]" value="$">
</span>
</h2>
<section>
<p>A popular activity among furries when they gather, although not to everyone's taste.</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="H[now]" value=""></th>
<th><input type="radio" name="H[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="H[now]" value="+++" title="H+++"></td>
<td><input type="radio" name="H[fut]" value="+++" title="H+++"></td>
<td>If it moves, I'll hug it (if it doesn't move, I'll hug it until it moves)</td>
</tr>
<tr>
<td><input type="radio" name="H[now]" value="++" title="H++"></td>
<td><input type="radio" name="H[fut]" value="++" title="H++"></td>
<td>I'll hug anyone I know, given a faint excuse</td>
</tr>
<tr>
<td><input type="radio" name="H[now]" value="+" title="H+"></td>
<td><input type="radio" name="H[fut]" value="+" title="H+"></td>
<td>I'll accept hugs, and maybe even give the occasional one</td>
</tr>
<tr>
<td><input type="radio" name="H[now]" value=" " title="H "></td>
<td><input type="radio" name="H[fut]" value=" " title="H "></td>
<td>Well, OK, you can hug me if you really want to</td>
</tr>
<tr>
<td><input type="radio" name="H[now]" value="-" title="H-"></td>
<td><input type="radio" name="H[fut]" value="-" title="H-"></td>
<td>Please don't, unless we know each other very well</td>
</tr>
<tr>
<td><input type="radio" name="H[now]" value="--" title="H--"></td>
<td><input type="radio" name="H[fut]" value="--" title="H--"></td>
<td>No way</td>
</tr>
<tr>
<td><input type="radio" name="H[now]" value="---" title="H---"></td>
<td><input type="radio" name="H[fut]" value="---" title="H---"></td>
<td>Argh! Don't touch me, you pervert!</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="M">Mucking and mudding</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="M[now][opt]" value="" data-clear="1">
<input type="radio" name="M[now][opt]" value="?">
<input type="radio" name="M[now][opt]" value="~">
<input type="radio" name="M[now][opt]" value="!">
<input type="radio" name="M[now][opt]" value="#">
</span>
<input type="checkbox" name="M[now][opt]" value="$">
</span>
</h2>
<section>
<p>Use this code to indicate how deeply involved you are in online multi-user universes such as FurryMuck.</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="M[now]" value=""></th>
<th><input type="radio" name="M[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="M[now]" value="++++" title="M++++"></td>
<td><input type="radio" name="M[fut]" value="++++" title="M++++"></td>
<td>I'm a Wizard, tremble before my might!</td>
</tr>
<tr>
<td><input type="radio" name="M[now]" value="+++" title="M+++"></td>
<td><input type="radio" name="M[fut]" value="+++" title="M+++"></td>
<td>Someday I may get around to trying Real Life, but it's not high on my agenda</td>
</tr>
<tr>
<td><input type="radio" name="M[now]" value="++" title="M++"></td>
<td><input type="radio" name="M[fut]" value="++" title="M++"></td>
<td>I've got characters on several MU*s, and frequently get frustrated when commands don't work in RL</td>
</tr>
<tr>
<td><input type="radio" name="M[now]" value="+" title="M+"></td>
<td><input type="radio" name="M[fut]" value="+" title="M+"></td>
<td>I'm a regular on at least one furry MU*</td>
</tr>
<tr>
<td><input type="radio" name="M[now]" value=" " title="M "></td>
<td><input type="radio" name="M[fut]" value=" " title="M "></td>
<td>Tried them once or twice, may do it again sometime</td>
</tr>
<tr>
<td><input type="radio" name="M[now]" value="-" title="M-"></td>
<td><input type="radio" name="M[fut]" value="-" title="M-"></td>
<td>Never been able to dredge up enough interest (or time) to try it</td>
</tr>
<tr>
<td><input type="radio" name="M[now]" value="--" title="M--"></td>
<td><input type="radio" name="M[fut]" value="--" title="M--"></td>
<td>Those things are for weenies</td>
</tr>
<tr>
<td><input type="radio" name="M[now]" value="---" title="M---"></td>
<td><input type="radio" name="M[fut]" value="---" title="M---"></td>
<td>You guys are pathetic, get a life!</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="P">Plush critters</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="P[now][opt]" value="" data-clear="1">
<input type="radio" name="P[now][opt]" value="?">
<input type="radio" name="P[now][opt]" value="~">
<input type="radio" name="P[now][opt]" value="!">
<input type="radio" name="P[now][opt]" value="#">
</span>
<input type="checkbox" name="P[now][opt]" value="$">
</span>
</h2>
<section>
<p>Well, until those genetic engineers get their act together and give us some real furries, we'll have to make do with these...</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="P[now]" value=""></th>
<th><input type="radio" name="P[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="P[now]" value="++++" title="P++++"></td>
<td><input type="radio" name="P[fut]" value="++++" title="P++++"></td>
<td>Where'd my plushie go? Oh, it's buried under my stuffies</td>
</tr>
<tr>
<td><input type="radio" name="P[now]" value="+++" title="P+++"></td>
<td><input type="radio" name="P[fut]" value="+++" title="P+++"></td>
<td>I collect every one I find of a certain species (or two, or three...)</td>
</tr>
<tr>
<td><input type="radio" name="P[now]" value="++" title="P++"></td>
 <td><input type="radio" name="P[fut]" value="++" title="P++"></td>
<td>I've got a collection of several favourites</td>
</tr>
<tr>
<td><input type="radio" name="P[now]" value="+" title="P+"></td>
<td><input type="radio" name="P[fut]" value="+" title="P+"></td>
<td>I have been known to cuddle a few</td>
</tr>
<tr>
<td><input type="radio" name="P[now]" value=" " title="P "></td>
<td><input type="radio" name="P[fut]" value=" " title="P "></td>
<td>I like them, they sit on my shelves collecting dust</td>
</tr>
<tr>
<td><input type="radio" name="P[now]" value="-" title="P-"></td>
<td><input type="radio" name="P[fut]" value="-" title="P-"></td>
<td>No thanks, they'll sit on my shelves collecting dust</td>
</tr>
<tr>
<td><input type="radio" name="P[now]" value="--" title="P--"></td>
<td><input type="radio" name="P[fut]" value="--" title="P--"></td>
<td>Kid stuff, I'd sooner hug a pincushion</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="R">Realism vs. tooniness</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="R[now][opt]" value="" data-clear="1">
<input type="radio" name="R[now][opt]" value="?">
<input type="radio" name="R[now][opt]" value="~">
<input type="radio" name="R[now][opt]" value="!">
<input type="radio" name="R[now][opt]" value="#">
</span>
<input type="checkbox" name="R[now][opt]" value="$" disabled="">
</span>
</h2>
<section>
<p>Do you prefer your furries anatomically correct (if that makes sense), or cartoonish, or somewhere in between?</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="R[now]" value=""></th>
<th><input type="radio" name="R[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="R[now]" value="+++" title="R+++"></td>
<td><input type="radio" name="R[fut]" value="+++" title="R+++"></td>
<td>What do you mean it isn't a photograph?</td>
</tr>
<tr>
<td><input type="radio" name="R[now]" value="++" title="R++"></td>
<td><input type="radio" name="R[fut]" value="++" title="R++"></td>
<td>Figments of the imagination have anatomies too, you know</td>
</tr>
<tr>
<td><input type="radio" name="R[now]" value="+" title="R+"></td>
<td><input type="radio" name="R[fut]" value="+" title="R+"></td>
<td>I like both, but prefer realistic furries</td>
</tr>
<tr>
<td><input type="radio" name="R[now]" value=" " title="R "></td>
<td><input type="radio" name="R[fut]" value=" " title="R "></td>
<td>No particular preference</td>
</tr>
<tr>
<td><input type="radio" name="R[now]" value="-" title="R-"></td>
<td><input type="radio" name="R[fut]" value="-" title="R-"></td>
<td>I like both, but prefer toons</td>
</tr>
<tr>
<td><input type="radio" name="R[now]" value="--" title="R--"></td>
<td><input type="radio" name="R[fut]" value="--" title="R--"></td>
<td>The toonier the better</td>
</tr>
<tr>
<td><input type="radio" name="R[now]" value="---" title="R---"></td>
<td><input type="radio" name="R[fut]" value="---" title="R---"></td>
<td>If it's not Super-Deformed I don't want to know about it</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="T">Transformation</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="T[now][opt]" value="" data-clear="1">
<input type="radio" name="T[now][opt]" value="?">
<input type="radio" name="T[now][opt]" value="~">
<input type="radio" name="T[now][opt]" value="!">
<input type="radio" name="T[now][opt]" value="#">
</span>
<input type="checkbox" name="T[now][opt]" value="$" disabled="">
</span>
</h2>
<section>
<p>If you had the chance, would you want to become a real furry?</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="T[now]" value=""></th>
<th><input type="radio" name="T[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="T[now]" value="++++" title="T++++"></td>
<td><input type="radio" name="T[fut]" value="++++" title="T++++"></td>
<td>Never mind the fine print, where do I sign?</td>
</tr>
<tr>
<td><input type="radio" name="T[now]" value="+++" title="T+++"></td>
<td><input type="radio" name="T[fut]" value="+++" title="T+++"></td>
<td>Definitely! (as long as I get to choose the species)</td>
</tr>
<tr>
<td><input type="radio" name="T[now]" value="++" title="T++"></td>
<td><input type="radio" name="T[fut]" value="++" title="T++"></td>
<td>Yes, if it's reversible</td>
 </tr>
<tr>
<td><input type="radio" name="T[now]" value="+" title="T+"></td>
<td><input type="radio" name="T[fut]" value="+" title="T+"></td>
<td>Probably, as long as I wasn't the first guinea pig (or whatever...)</td>
</tr>
<tr>
<td><input type="radio" name="T[now]" value=" " title="T "></td>
<td><input type="radio" name="T[fut]" value=" " title="T "></td>
<td>I'd have to think about it carefully</td>
</tr>
<tr>
<td><input type="radio" name="T[now]" value="-" title="T-"></td>
<td><input type="radio" name="T[fut]" value="-" title="T-"></td>
<td>Not personally</td>
</tr>
<tr>
<td><input type="radio" name="T[now]" value="--" title="T--"></td>
<td><input type="radio" name="T[fut]" value="--" title="T--"></td>
<td>What a horrible idea!</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="W">Writing</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="W[now][opt]" value="" data-clear="1">
<input type="radio" name="W[now][opt]" value="?">
<input type="radio" name="W[now][opt]" value="~">
<input type="radio" name="W[now][opt]" value="!">
<input type="radio" name="W[now][opt]" value="#">
</span>
<input type="checkbox" name="W[now][opt]" value="$">
</span>
</h2>
<section>
<p>For those who have tried their paw at telling us some grim (or even not-so-grim) furry tails.</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="W[now]" value=""></th>
<th><input type="radio" name="W[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="W[now]" value="++++" title="W++++"></td>
<td><input type="radio" name="W[fut]" value="++++" title="W++++"></td>
<td>I've out-sold Anne McCaffrey <em>(furry-related)</em></td>
</tr>
<tr>
<td><input type="radio" name="W[now]" value="****" title="W****"></td>
<td><input type="radio" name="W[fut]" value="****" title="W****"></td>
<td>I've out-sold Anne McCaffrey <em>(<strong>not</strong> furry-related)</em></td>
</tr>
<tr>
<td><input type="radio" name="W[now]" value="+++" title="W+++"></td>
<td><input type="radio" name="W[fut]" value="+++" title="W+++"></td>
<td>I've sold a book <em>(furry-related)</em></td>
</tr>
<tr>
<td><input type="radio" name="W[now]" value="***" title="W***"></td>
<td><input type="radio" name="W[fut]" value="***" title="W***"></td>
<td>I've sold a book <em>(<strong>not</strong> furry-related)</em></td>
</tr>
<tr>
<td><input type="radio" name="W[now]" value="++" title="W++"></td>
<td><input type="radio" name="W[fut]" value="++" title="W++"></td>
<td>I've sold a story to a <em>real</em> magazine (duck) <em>(furry-related)</em></td>
</tr>
<tr>
<td><input type="radio" name="W[now]" value="**" title="W**"></td>
<td><input type="radio" name="W[fut]" value="**" title="W**"></td>
<td>I've sold a story to a <em>real</em> magazine (duck) <em>(<strong>not</strong> furry-related)</em></td>
</tr>
<tr>
<td><input type="radio" name="W[now]" value="+" title="W+"></td>
<td><input type="radio" name="W[fut]" value="+" title="W+"></td>
<td>I've sold stuff to fanzines <em>(furry-related)</em></td>
</tr>
<tr>
<td><input type="radio" name="W[now]" value="*" title="W*"></td>
<td><input type="radio" name="W[fut]" value="*" title="W*"></td>
<td>I've sold stuff to fanzines <em>(<strong>not</strong> furry-related)</em></td>
</tr>
<tr>
<td><input type="radio" name="W[now]" value=" " title="W "></td>
<td><input type="radio" name="W[fut]" value=" " title="W "></td>
<td>I've written a story that somebody else has read</td>
</tr>
<tr>
<td><input type="radio" name="W[now]" value="-" title="W-"></td>
<td><input type="radio" name="W[fut]" value="-" title="W-"></td>
<td>I have these scribblings but <em>nobody</em> is ever going to see them!</td>
</tr>
<tr>
<td><input type="radio" name="W[now]" value="--" title="W--"></td>
<td><input type="radio" name="W[fut]" value="--" title="W--"></td>
<td>Never written a word of fiction (Inland Revenue forms excepted)</td>
</tr>
<tr>
<td><input type="radio" name="W[now]" value="---" title="W---"></td>
<td><input type="radio" name="W[fut]" value="---" title="W---"></td>
<td>Illiterate</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="Z">Zines</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="Z[now][opt]" value="" data-clear="1">
<input type="radio" name="Z[now][opt]" value="?">
<input type="radio" name="Z[now][opt]" value="~">
<input type="radio" name="Z[now][opt]" value="!">
<input type="radio" name="Z[now][opt]" value="#">
</span>
<input type="checkbox" name="Z[now][opt]" value="$">
</span>
</h2>
<section>
<p>Use this code to indicate how deeply involved you are in the furry fanzine and comic scene.</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="Z[now]" value=""></th>
<th><input type="radio" name="Z[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="Z[now]" value="++++" title="Z++++"></td>
<td><input type="radio" name="Z[fut]" value="++++" title="Z++++"></td>
<td>Publisher/editor/other staff on a professional furry-related publication (should have the <em>$</em> modifier)</td>
</tr>
<tr>
<td><input type="radio" name="Z[now]" value="+++" title="Z+++"></td>
<td><input type="radio" name="Z[fut]" value="+++" title="Z+++"></td>
<td>I work on a regularly-published amateur zine, or I'm a frequently-published author/artist</td>
</tr>
<tr>
<td><input type="radio" name="Z[now]" value="++" title="Z++"></td>
<td><input type="radio" name="Z[fut]" value="++" title="Z++"></td>
<td>I've been published, or directly involved in a publication, at least once</td>
</tr>
<tr>
<td><input type="radio" name="Z[now]" value="+" title="Z+"></td>
<td><input type="radio" name="Z[fut]" value="+" title="Z+"></td>
<td>I have a good collection, and buy at least one title regularly</td>
</tr>
<tr>
<td><input type="radio" name="Z[now]" value=" " title="Z "></td>
<td><input type="radio" name="Z[fut]" value=" " title="Z "></td>
<td>I have a few furry zines</td>
</tr>
<tr>
<td><input type="radio" name="Z[now]" value="-" title="Z-"></td>
<td><input type="radio" name="Z[fut]" value="-" title="Z-"></td>
<td>Not really interested</td>
</tr>
<tr>
<td><input type="radio" name="Z[now]" value="--" title="Z--"></td>
<td><input type="radio" name="Z[fut]" value="--" title="Z--"></td>
<td>Comics are for kids</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="S">Furry Sex</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="S[now][opt]" value="" data-clear="1">
<input type="radio" name="S[now][opt]" value="?">
<input type="radio" name="S[now][opt]" value="~">
<input type="radio" name="S[now][opt]" value="!">
<input type="radio" name="S[now][opt]" value="#">
</span>
<input type="checkbox" name="S[now][opt]" value="$">
</span>
</h2>
<section>
<p>Like it or not, S-*-X seems to be part of furry life. Use this code, if you wish, to indicate the sex (and sex life) of your furry persona. Feel free to use the <em>#</em> ("mind your own business") or <em>!</em> ("nothing to do with me") modifiers if you prefer.</p>
<h3>Character's Sex</h3>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="S[now][pmod]" value=""></th>
<th><input type="radio" name="S[fut][pmod]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="S[now][pmod]" value="f" title="Sf"></td>
<td><input type="radio" name="S[fut][pmod]" value="f" title="Sf"></td>
<td>Female</td>
</tr>
<tr>
<td><input type="radio" name="S[now][pmod]" value="h" title="Sh"></td>
<td><input type="radio" name="S[fut][pmod]" value="h" title="Sh"></td>
<td>Hermaphrodite</td>
</tr>
<tr>
<td><input type="radio" name="S[now][pmod]" value="m" title="Sm"></td>
<td><input type="radio" name="S[fut][pmod]" value="m" title="Sm"></td>
<td>Male</td>
</tr>
<tr>
<td><input type="radio" name="S[now][pmod]" value="p" title="Sp"></td>
<td><input type="radio" name="S[fut][pmod]" value="p" title="Sp"></td>
<td>Polymorph (can change sex at will)</td>
</tr>
</tbody>
</table>
<h3>What's Their Sex Life Like?</h3>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="S[now]" value=""></th>
<th><input type="radio" name="S[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="S[now]" value="+++" title="S+++"></td>
<td><input type="radio" name="S[fut]" value="+++" title="S+++"></td>
<td>What do you mean there are other things to do?</td>
</tr>
<tr>
<td><input type="radio" name="S[now]" value="++" title="S++"></td>
<td><input type="radio" name="S[fut]" value="++" title="S++"></td>
<td>Ready, willing, and able</td>
</tr>
<tr>
<td><input type="radio" name="S[now]" value="+" title="S+"></td>
<td><input type="radio" name="S[fut]" value="+" title="S+"></td>
<td>I've had TinySex</td>
</tr>
<tr>
<td><input type="radio" name="S[now]" value=" " title="S "></td>
<td><input type="radio" name="S[fut]" value=" " title="S "></td>
<td>Never had TinySex, but wouldn't rule it out</td>
</tr>
<tr>
<td><input type="radio" name="S[now]" value="-" title="S-"></td>
<td><input type="radio" name="S[fut]" value="-" title="S-"></td>
<td>Celibate</td>
</tr>
<tr>
<td><input type="radio" name="S[now]" value="--" title="S--"></td>
<td><input type="radio" name="S[fut]" value="--" title="S--"></td>
 <td>You people are sick!</td>
</tr>
</tbody>
</table>
</section>
</div>
</div>
<div class="outer human">
<h1>Your Human Side</h1>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="RL">What you do in Real Life</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="RL[now][opt]" value="" data-clear="1">
<input type="radio" name="RL[now][opt]" value="?">
<input type="radio" name="RL[now][opt]" value="~">
<input type="radio" name="RL[now][opt]" value="!">
<input type="radio" name="RL[now][opt]" value="#">
</span>
<input type="checkbox" name="RL[now][opt]" value="$" disabled="">
</span>
</h2>
<section>
<p>Unfortunately, we can't yet be furries in Real Life (you know -- that boring game you play when the computer's down and there's nothing on TV), so we have to find something else to do. This code indicates what you do for a living, or what you're studying to do for a living, or what you do to avoid living.</p>
<p>(The <em>$</em> modifier shouldn't be used here, since it's taken for granted that this represents your day job, or the nearest thing you have to one.)</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="RL[now]" value=""></th>
<th><input type="radio" name="RL[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="RL[now]" value="RLA" title="RLRLA"></td>
<td><input type="radio" name="RL[fut]" value="RLA" title="RLRLA"></td>
<td>Art</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLBM" title="RLRLBM"></td>
<td><input type="radio" name="RL[fut]" value="RLBM" title="RLRLBM"></td>
<td>Business/management</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLC" title="RLRLC"></td>
<td><input type="radio" name="RL[fut]" value="RLC" title="RLRLC"></td>
<td>Craft</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLCI" title="RLRLCI"></td>
<td><input type="radio" name="RL[fut]" value="RLCI" title="RLRLCI"></td>
<td>Construction industry</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLCT" title="RLRLCT"></td>
<td><input type="radio" name="RL[fut]" value="RLCT" title="RLRLCT"></td>
<td>Computers/information technology</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLE" title="RLRLE"></td>
<td><input type="radio" name="RL[fut]" value="RLE" title="RLRLE"></td>
<td>Engineering</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLET" title="RLRLET"></td>
<td><input type="radio" name="RL[fut]" value="RLET" title="RLRLET"></td>
<td>Education/teaching</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLF" title="RLRLF"></td>
<td><input type="radio" name="RL[fut]" value="RLF" title="RLRLF"></td>
<td>Farming</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLFB" title="RLRLFB"></td>
<td><input type="radio" name="RL[fut]" value="RLFB" title="RLRLFB"></td>
<td>Finance/banking</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLGP" title="RLRLGP"></td>
<td><input type="radio" name="RL[fut]" value="RLGP" title="RLRLGP"></td>
<td>Government/public service</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLL" title="RLRLL"></td>
<td><input type="radio" name="RL[fut]" value="RLL" title="RLRLL"></td>
<td>Law</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLLW" title="RLRLLW"></td>
<td><input type="radio" name="RL[fut]" value="RLLW" title="RLRLLW"></td>
<td>Literature/writing</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLM" title="RLRLM"></td>
<td><input type="radio" name="RL[fut]" value="RLM" title="RLRLM"></td>
<td>Music</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLMA" title="RLRLMA"></td>
<td><input type="radio" name="RL[fut]" value="RLMA" title="RLRLMA"></td>
<td>Military/armed forces</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLMC" title="RLRLMC"></td>
<td><input type="radio" name="RL[fut]" value="RLMC" title="RLRLMC"></td>
<td>Media/communications</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLMH" title="RLRLMH"></td>
<td><input type="radio" name="RL[fut]" value="RLMH" title="RLRLMH"></td>
<td>Medicine (human)</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLRB" title="RLRLRB"></td>
<td><input type="radio" name="RL[fut]" value="RLRB" title="RLRLRB"></td>
<td>Retail business</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLS" title="RLRLS"></td>
<td><input type="radio" name="RL[fut]" value="RLS" title="RLRLS"></td>
<td>Science</td>
</tr>
<tr>
 <td><input type="radio" name="RL[now]" value="RLTH" title="RLRLTH"></td>
<td><input type="radio" name="RL[fut]" value="RLTH" title="RLRLTH"></td>
<td>Theatre</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLTI" title="RLRLTI"></td>
<td><input type="radio" name="RL[fut]" value="RLTI" title="RLRLTI"></td>
<td>Transport industry</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLVM" title="RLRLVM"></td>
<td><input type="radio" name="RL[fut]" value="RLVM" title="RLRLVM"></td>
<td>Veterinary medicine</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLAT" title="RLRLAT"></td>
<td><input type="radio" name="RL[fut]" value="RLAT" title="RLRLAT"></td>
<td>I'm a furry of all trades <em>("Specialisation is for insects!" -- Robert Heinlein)</em></td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RLU" title="RLRLU"></td>
<td><input type="radio" name="RL[fut]" value="RLU" title="RLRLU"></td>
<td>Undecided (generally used by young students who haven't picked a major yet)</td>
</tr>
<tr>
<td><input type="radio" name="RL[now]" value="RL-" title="RLRL-"></td>
<td><input type="radio" name="RL[fut]" value="RL-" title="RLRL-"></td>
<td>No qualifications, no job, no complaints!</td>
</tr>
</tbody>
</table>
<p>And a little extra...</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="checkbox" name="RL[now][mod][0]" value="*" title="RL*"></td>
<td><input type="checkbox" name="RL[fut][mod][0]" value="*" title="RL*"></td>
<td>I'm trained or experienced in this field, but haven't managed to persuade anyone to actually pay me to do it yet (this doesn't apply to <em>RLU</em> or <em>RL-</em>).</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="a">Age</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="a[now][opt]" value="" data-clear="1">
<input type="radio" name="a[now][opt]" value="?" disabled="">
<input type="radio" name="a[now][opt]" value="~">
<input type="radio" name="a[now][opt]" value="!">
<input type="radio" name="a[now][opt]" value="#">
</span>
<input type="checkbox" name="a[now][opt]" value="$" disabled="">
</span>
</h2>
<section>
<p>So, how long have you been a human being? <em>("Three foot six!")</em></p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="a[now]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="a[now]" value="++++" title="a++++"></td>
<td>60+ years</td>
</tr>
<tr>
<td><input type="radio" name="a[now]" value="+++" title="a+++"></td>
<td>50-59 years</td>
</tr>
<tr>
<td><input type="radio" name="a[now]" value="++" title="a++"></td>
<td>40-49 years</td>
</tr>
<tr>
<td><input type="radio" name="a[now]" value="+" title="a+"></td>
<td>30-39 years</td>
</tr>
<tr>
<td><input type="radio" name="a[now]" value=" " title="a "></td>
<td>20-29 years</td>
</tr>
<tr>
<td><input type="radio" name="a[now]" value="-" title="a-"></td>
<td>10-19 years</td>
</tr>
<tr>
<td><input type="radio" name="a[now]" value="--" title="a--"></td>
<td>Under 10 years</td>
</tr>
<tr>
<td><input type="radio" name="a[now]" value=" " data-custom="1" data-customjustvalue="1" title="a##"></td>
<td><input type="text" name="a[now]" placeholder="Specific Age"></td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="c">Computers</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="c[now][opt]" value="" data-clear="1">
<input type="radio" name="c[now][opt]" value="?">
<input type="radio" name="c[now][opt]" value="~">
<input type="radio" name="c[now][opt]" value="!">
<input type="radio" name="c[now][opt]" value="#">
</span>
<input type="checkbox" name="c[now][opt]" value="$">
</span>
</h2>
<section>
<p>Since you're probably reading this on a computer screen, there's a good chance you have some familiarity with the technology. Use this code to tell us how much of a Computer Geek you are.</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="c[now]" value=""></th>
<th><input type="radio" name="c[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="c[now]" value="++++" title="c++++"></td>
<td><input type="radio" name="c[fut]" value="++++" title="c++++"></td>
 <td>I'll be first in line to get a cybernetic interface installed in my skull!</td>
</tr>
<tr>
<td><input type="radio" name="c[now]" value="+++" title="c+++"></td>
<td><input type="radio" name="c[fut]" value="+++" title="c+++"></td>
<td>Hey, if there was anything else to life, there'd be a newsgroup about it</td>
</tr>
<tr>
<td><input type="radio" name="c[now]" value="++" title="c++"></td>
<td><input type="radio" name="c[fut]" value="++" title="c++"></td>
<td>Computers are a large part of my life; I spend time every day in front of one; I've tried my hand at programming</td>
</tr>
<tr>
<td><input type="radio" name="c[now]" value="+" title="c+"></td>
<td><input type="radio" name="c[fut]" value="+" title="c+"></td>
<td>Computers are fun; I can use some software without resorting to the manual; I play a mean game of [insert favourite game]</td>
</tr>
<tr>
<td><input type="radio" name="c[now]" value=" " title="c "></td>
<td><input type="radio" name="c[fut]" value=" " title="c "></td>
<td>Computers are just a tool; I use one when it serves my purpose</td>
</tr>
<tr>
<td><input type="radio" name="c[now]" value="-" title="c-"></td>
<td><input type="radio" name="c[fut]" value="-" title="c-"></td>
<td>I'm nervous of anything more complicated than my microwave</td>
</tr>
<tr>
<td><input type="radio" name="c[now]" value="--" title="c--"></td>
<td><input type="radio" name="c[fut]" value="--" title="c--"></td>
<td>Where's the "on" switch? Better yet, where's the "off" switch?</td>
</tr>
<tr>
<td><input type="radio" name="c[now]" value="---" title="c---"></td>
<td><input type="radio" name="c[fut]" value="---" title="c---"></td>
<td>They're taking over the world! Smash the machines! Up the Luddites!</td>
</tr>
</tbody>
</table>
<p>If your rating is at least <em>c</em>, add one or more of the following letters to indicate your preferred operating environment:</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="c[now][pmod]" value="a" title="ca"></td>
<td><input type="radio" name="c[fut][pmod]" value="a" title="ca"></td>
<td>Amiga</td>
</tr>
<tr>
<td><input type="radio" name="c[now][pmod]" value="b" title="cb"></td>
<td><input type="radio" name="c[fut][pmod]" value="b" title="cb"></td>
<td>BSD Unix</td>
</tr>
<tr>
 <td><input type="radio" name="c[now][pmod]" value="d" title="cd"></td>
<td><input type="radio" name="c[fut][pmod]" value="d" title="cd"></td>
<td>MS-DOS</td>
</tr>
<tr>
<td><input type="radio" name="c[now][pmod]" value="l" title="cl"></td>
<td><input type="radio" name="c[fut][pmod]" value="l" title="cl"></td>
<td>Linux</td>
</tr>
<tr>
<td><input type="radio" name="c[now][pmod]" value="m" title="cm"></td>
<td><input type="radio" name="c[fut][pmod]" value="m" title="cm"></td>
<td>Macintosh</td>
</tr>
<tr>
<td><input type="radio" name="c[now][pmod]" value="n" title="cn"></td>
<td><input type="radio" name="c[fut][pmod]" value="n" title="cn"></td>
<td>Windows</td>
</tr>
<tr>
<td><input type="radio" name="c[now][pmod]" value="o" title="co"></td>
<td><input type="radio" name="c[fut][pmod]" value="o" title="co"></td>
<td>OS/2</td>
</tr>
<tr>
<td><input type="radio" name="c[now][pmod]" value="u" title="cu"></td>
<td><input type="radio" name="c[fut][pmod]" value="u" title="cu"></td>
<td>Unix (commercial)</td>
</tr>
<tr>
<td><input type="radio" name="c[now][pmod]" value="v" title="cv"></td>
<td><input type="radio" name="c[fut][pmod]" value="v" title="cv"></td>
<td>VMS</td>
</tr>
<tr>
<td><input type="radio" name="c[now][pmod]" value="w" title="cw"></td>
<td><input type="radio" name="c[fut][pmod]" value="w" title="cw"></td>
<td>Windows 3.x</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="d">Doom, Quake, etc.</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="d[now][opt]" value="" data-clear="1">
<input type="radio" name="d[now][opt]" value="?">
<input type="radio" name="d[now][opt]" value="~">
<input type="radio" name="d[now][opt]" value="!">
<input type="radio" name="d[now][opt]" value="#">
</span>
<input type="checkbox" name="d[now][opt]" value="$">
</span>
</h2>
<section>
<p>ID Games' <em>Doom</em> and <em>Quake</em>, and related games (<em>Dark Forces</em>, <em>Duke Nukem 3D</em>, <em>Heretic</em>, <em>Hexen</em>, etc), seem to be at least as hugely popular among furries as they are among the population at large. What is it about running around with heavy-calibre weaponry shooting the shit out of everything in sight that appeals to us? Or does that question answer itself?</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="d[now]" value=""></th>
<th><input type="radio" name="d[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="d[now]" value="++++" title="d++++"></td>
<td><input type="radio" name="d[fut]" value="++++" title="d++++"></td>
<td>I work for ID, bow down before me</td>
</tr>
<tr>
<td><input type="radio" name="d[now]" value="+++" title="d+++"></td>
<td><input type="radio" name="d[fut]" value="+++" title="d+++"></td>
<td>I can solve every level in Nightmare mode with my eyes shut; I crank out new WAD files daily</td>
</tr>
<tr>
<td><input type="radio" name="d[now]" value="++" title="d++"></td>
<td><input type="radio" name="d[fut]" value="++" title="d++"></td>
<td>I've got pretty good at it; I can get through most levels easily; I've downloaded and played other WADs</td>
</tr>
<tr>
<td><input type="radio" name="d[now]" value="+" title="d+"></td>
<td><input type="radio" name="d[fut]" value="+" title="d+"></td>
<td>It's a fun, action game that is a nice diversion on a lazy afternoon</td>
</tr>
<tr>
<td><input type="radio" name="d[now]" value=" " title="d "></td>
<td><input type="radio" name="d[fut]" value=" " title="d "></td>
<td>I've played the game and I'm pretty indifferent</td>
</tr>
<tr>
<td><input type="radio" name="d[now]" value="-" title="d-"></td>
<td><input type="radio" name="d[fut]" value="-" title="d-"></td>
<td>I've played the game and really didn't think it was all that impressive</td>
</tr>
<tr>
<td><input type="radio" name="d[now]" value="--" title="d--"></td>
<td><input type="radio" name="d[fut]" value="--" title="d--"></td>
<td>I miss Zork</td>
</tr>
<tr>
<td><input type="radio" name="d[now]" value="---" title="d---"></td>
<td><input type="radio" name="d[fut]" value="---" title="d---"></td>
<td>All this violence is sickening; there ought to be a law</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="e">Education</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="e[now][opt]" value="" data-clear="1">
<input type="radio" name="e[now][opt]" value="?">
<input type="radio" name="e[now][opt]" value="~">
<input type="radio" name="e[now][opt]" value="!">
<input type="radio" name="e[now][opt]" value="#">
</span>
<input type="checkbox" name="e[now][opt]" value="$" disabled="">
</span>
</h2>
<section>
<p>How far have you managed to crawl up the academic ladder?</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="e[now]" value=""></th>
<th><input type="radio" name="e[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="e[now]" value="++++" title="e++++"></td>
<td><input type="radio" name="e[fut]" value="++++" title="e++++"></td>
<td>Doctorate, or the equivalent</td>
</tr>
<tr>
<td><input type="radio" name="e[now]" value="+++" title="e+++"></td>
<td><input type="radio" name="e[fut]" value="+++" title="e+++"></td>
<td>Master's degree, or the equivalent</td>
</tr>
<tr>
<td><input type="radio" name="e[now]" value="++" title="e++"></td>
<td><input type="radio" name="e[fut]" value="++" title="e++"></td>
<td>Bachelor's degree, or the equivalent</td>
</tr>
<tr>
<td><input type="radio" name="e[now]" value="+" title="e+"></td>
<td><input type="radio" name="e[fut]" value="+" title="e+"></td>
<td>Some tertiary education</td>
</tr>
<tr>
<td><input type="radio" name="e[now]" value=" " title="e "></td>
<td><input type="radio" name="e[fut]" value=" " title="e "></td>
<td>Finished high school</td>
</tr>
<tr>
<td><input type="radio" name="e[now]" value="-" title="e-"></td>
<td><input type="radio" name="e[fut]" value="-" title="e-"></td>
<td>Haven't finished high school</td>
</tr>
<tr>
<td><input type="radio" name="e[now]" value="--" title="e--"></td>
<td><input type="radio" name="e[fut]" value="--" title="e--"></td>
<td>Haven't started high school</td>
</tr>
<tr>
<td><input type="radio" name="e[now]" value="*" title="e*"></td>
<td><input type="radio" name="e[fut]" value="*" title="e*"></td>
<td>Learned everything there is to know about life from <em>The Hitch-Hiker's Guide to the Galaxy</em>, my collection of <em>Omaha</em> comics, and late-night reruns of <em>Star Trek</em> and <em>The Prisoner</em></td>
</tr>
<tr>
<td><input type="radio" name="e[now]" value="**" title="e**"></td>
<td><input type="radio" name="e[fut]" value="**" title="e**"></td>
<td>Graduate degree from the School of Hard Knocks</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="f">Real life furriness factor</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="f[now][opt]" value="" data-clear="1">
<input type="radio" name="f[now][opt]" value="?">
<input type="radio" name="f[now][opt]" value="~">
<input type="radio" name="f[now][opt]" value="!">
<input type="radio" name="f[now][opt]" value="#">
</span>
<input type="checkbox" name="f[now][opt]" value="$" disabled="">
</span>
</h2>
<section>
<p>How far does furryness spill over into your other life? Or, to put it another way, how far do you allow the mundane world to get in the way of the important things in life?</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="f[now]" value=""></th>
<th><input type="radio" name="f[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="f[now]" value="++++" title="f++++"></td>
<td><input type="radio" name="f[fut]" value="++++" title="f++++"></td>
<td>I am not a human, I am a furry!</td>
</tr>
<tr>
<td><input type="radio" name="f[now]" value="+++" title="f+++"></td>
<td><input type="radio" name="f[fut]" value="+++" title="f+++"></td>
<td>I've been known to bark at people I don't know to greet them</td>
</tr>
<tr>
<td><input type="radio" name="f[now]" value="++" title="f++"></td>
<td><input type="radio" name="f[fut]" value="++" title="f++"></td>
<td>I've been known to bark at friends to greet them</td>
</tr>
<tr>
<td><input type="radio" name="f[now]" value="+" title="f+"></td>
<td><input type="radio" name="f[fut]" value="+" title="f+"></td>
<td>I make frequent jokes, show friends my furry art collection</td>
</tr>
<tr>
<td><input type="radio" name="f[now]" value=" " title="f "></td>
<td><input type="radio" name="f[fut]" value=" " title="f "></td>
<td>I make an occasional reference to my furriness</td>
</tr>
<tr>
<td><input type="radio" name="f[now]" value="-" title="f-"></td>
<td><input type="radio" name="f[fut]" value="-" title="f-"></td>
<td>I only tell close friends</td>
</tr>
<tr>
<td><input type="radio" name="f[now]" value="--" title="f--"></td>
<td><input type="radio" name="f[fut]" value="--" title="f--"></td>
<td>I tell <em>nobody</em></td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="h">Housing</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="h[now][opt]" value="" data-clear="1">
<input type="radio" name="h[now][opt]" value="?">
<input type="radio" name="h[now][opt]" value="~">
<input type="radio" name="h[now][opt]" value="!">
<input type="radio" name="h[now][opt]" value="#">
</span>
<input type="checkbox" name="h[now][opt]" value="$" disabled="">
</span>
</h2>
<section>
<p>What sort of home do you live in?</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="h[now]" value=""></th>
<th><input type="radio" name="h[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="h[now]" value="++++" title="h++++"></td>
<td><input type="radio" name="h[fut]" value="++++" title="h++++"></td>
<td>Married ... with children</td>
</tr>
<tr>
<td><input type="radio" name="h[now]" value="+++" title="h+++"></td>
<td><input type="radio" name="h[fut]" value="+++" title="h+++"></td>
<td>Married, or shacked up with your SO on a long-term basis</td>
</tr>
<tr>
<td><input type="radio" name="h[now]" value="++" title="h++"></td>
<td><input type="radio" name="h[fut]" value="++" title="h++"></td>
<td>Living with one or more fellow furries</td>
</tr>
<tr>
<td><input type="radio" name="h[now]" value="+" title="h+"></td>
<td><input type="radio" name="h[fut]" value="+" title="h+"></td>
<td>Living with one or more people who know nothing about furriness</td>
</tr>
<tr>
<td><input type="radio" name="h[now]" value=" " title="h "></td>
<td><input type="radio" name="h[fut]" value=" " title="h "></td>
<td>Living alone, other furries come to visit</td>
</tr>
<tr>
<td><input type="radio" name="h[now]" value="-" title="h-"></td>
<td><input type="radio" name="h[fut]" value="-" title="h-"></td>
<td>Living alone, get out once a week to buy food, all surfaces covered in computers and/or zines</td>
</tr>
<tr>
<td><input type="radio" name="h[now]" value="--" title="h--"></td>
<td><input type="radio" name="h[fut]" value="--" title="h--"></td>
<td>Living in a cave with 47 computers and a T1 line</td>
</tr>
<tr>
<td><input type="radio" name="h[now]" value="*" title="h*"></td>
<td><input type="radio" name="h[fut]" value="*" title="h*"></td>
<td>I'm still stuck living with my parents</td>
</tr>
<tr>
<td><input type="radio" name="h[now]" value="**" title="h**"></td>
<td><input type="radio" name="h[fut]" value="**" title="h**"></td>
<td>I'm not sure where I live any more; my workplace/lab seems like home to me</td>
</tr>
<tr>
<td><input type="radio" name="h[now]" value="***" title="h***"></td>
<td><input type="radio" name="h[fut]" value="***" title="h***"></td>
<td>Homeless</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="i">Internet</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="i[now][opt]" value="" data-clear="1">
<input type="radio" name="i[now][opt]" value="?">
<input type="radio" name="i[now][opt]" value="~">
<input type="radio" name="i[now][opt]" value="!">
<input type="radio" name="i[now][opt]" value="#">
</span>
<input type="checkbox" name="i[now][opt]" value="$">
</span>
</h2>
<section>
<p>The Internet, and its various sub-media and related media (Usenet, email, World-Wide Web, MUCKs and MUDs, IRC, FTP sites, and gods know what else), has quickly become a leading medium of communication among furries (not to mention the rest of the technologically aware universe). How deeply have you dived in?</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="i[now]" value=""></th>
<th><input type="radio" name="i[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="i[now]" value="+++" title="i+++"></td>
<td><input type="radio" name="i[fut]" value="+++" title="i+++"></td>
<td>I'm a Webmaster/site administrator</td>
</tr>
<tr>
<td><input type="radio" name="i[now]" value="++" title="i++"></td>
<td><input type="radio" name="i[fut]" value="++" title="i++"></td>
<td>I spend most of my spare time surfing the Web, and read any newsgroup that catches my interest</td>
</tr>
<tr>
<td><input type="radio" name="i[now]" value="+" title="i+"></td>
<td><input type="radio" name="i[fut]" value="+" title="i+"></td>
<td>I browse the Web regularly, and read a handful of newgroups</td>
</tr>
<tr>
<td><input type="radio" name="i[now]" value=" " title="i "></td>
<td><input type="radio" name="i[fut]" value=" " title="i "></td>
<td>I have a browser and a connection, and even use them occasionally</td>
</tr>
<tr>
<td><input type="radio" name="i[now]" value="-" title="i-"></td>
<td><input type="radio" name="i[fut]" value="-" title="i-"></td>
<td>Not connected yet</td>
</tr>
<tr>
<td><input type="radio" name="i[now]" value="--" title="i--"></td>
<td><input type="radio" name="i[fut]" value="--" title="i--"></td>
<td>The Internet sucks; it's all just a flash in the pan anyway</td>
</tr>
<tr>
<td><input type="radio" name="i[now]" value="---" title="i---"></td>
<td><input type="radio" name="i[fut]" value="---" title="i---"></td>
<td>It's a dangerous, subversive, perverted abomination that needs to be banned before people stop voting for me!</td>
</tr>
</tbody>
</table>
<p>And a little extra...</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="i[now][pmod]" value=""></th>
<th><input type="radio" name="i[fut][pmod]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="i[now][pmod]" value="w" title="iw"></td>
<td><input type="radio" name="i[fut][pmod]" value="w" title="iw"></td>
<td>I have my own home page on the Web</td>
</tr>
<tr>
<td><input type="radio" name="i[now][pmod]" value="wf" title="iwf"></td>
<td><input type="radio" name="i[fut][pmod]" value="wf" title="iwf"></td>
<td>I have my own home page, <em>that mentions furries</em>, on the Web</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="j">Anime (Japanese animation)</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="j[now][opt]" value="" data-clear="1">
<input type="radio" name="j[now][opt]" value="?">
<input type="radio" name="j[now][opt]" value="~">
<input type="radio" name="j[now][opt]" value="!">
<input type="radio" name="j[now][opt]" value="#">
</span>
<input type="checkbox" name="j[now][opt]" value="$">
</span>
</h2>
<section>
<p>Many of us are also avid fans of the genre of animation known as "Anime". You know, the kind where all the characters have huge eyes and even the bad guys are cute?</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="j[now]" value=""></th>
<th><input type="radio" name="j[fut]" value=""></th>
 <th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="j[now]" value="++++" title="j++++"></td>
<td><input type="radio" name="j[fut]" value="++++" title="j++++"></td>
<td>I am a writer/artist/<em>seyeiuu</em></td>
</tr>
<tr>
<td><input type="radio" name="j[now]" value="+++" title="j+++"></td>
<td><input type="radio" name="j[fut]" value="+++" title="j+++"></td>
<td>I own every episode of every series ever made</td>
</tr>
<tr>
<td><input type="radio" name="j[now]" value="++" title="j++"></td>
<td><input type="radio" name="j[fut]" value="++" title="j++"></td>
<td>I watch it in <em>all</em> my spare time (furry fandom is, of course, not spare time)</td>
</tr>
<tr>
<td><input type="radio" name="j[now]" value="+" title="j+"></td>
<td><input type="radio" name="j[fut]" value="+" title="j+"></td>
<td>Others know I'm an Anime fan</td>
</tr>
<tr>
<td><input type="radio" name="j[now]" value=" " title="j "></td>
<td><input type="radio" name="j[fut]" value=" " title="j "></td>
<td>Seen it, might think about seeing it again some time</td>
</tr>
<tr>
<td><input type="radio" name="j[now]" value="-" title="j-"></td>
<td><input type="radio" name="j[fut]" value="-" title="j-"></td>
<td>Haven't seen it, but would be interested when I get the time</td>
</tr>
<tr>
<td><input type="radio" name="j[now]" value="--" title="j--"></td>
<td><input type="radio" name="j[fut]" value="--" title="j--"></td>
<td>What's Anime?</td>
</tr>
<tr>
<td><input type="radio" name="j[now]" value="---" title="j---"></td>
<td><input type="radio" name="j[fut]" value="---" title="j---"></td>
<td>There should be a law against anything that cute</td>
</tr>
<tr>
<td><input type="radio" name="j[now]" value="*" title="j*"></td>
<td><input type="radio" name="j[fut]" value="*" title="j*"></td>
<td>I'll watch it, but <em>only</em> if it's all in English</td>
</tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="p">Pets</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="p[now][opt]" value="" data-clear="1">
<input type="radio" name="p[now][opt]" value="?">
<input type="radio" name="p[now][opt]" value="~">
<input type="radio" name="p[now][opt]" value="!">
<input type="radio" name="p[now][opt]" value="#">
</span>
<input type="checkbox" name="p[now][opt]" value="$">
</span>
</h2>
<section>
<p>If we can't be furries in Real Life (yet), at least we can do the next best thing and cohabit with them.</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="p[now]" value=""></th>
<th><input type="radio" name="p[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="p[now]" value="+++" title="p+++"></td>
<td><input type="radio" name="p[fut]" value="+++" title="p+++"></td>
<td>I have a vast household of assorted furry/scaly/feathery creatures, and my life is organised for their benefit</td>
</tr>
<tr>
<td><input type="radio" name="p[now]" value="++" title="p++"></td>
<td><input type="radio" name="p[fut]" value="++" title="p++"></td>
<td>Several pets</td>
</tr>
<tr>
<td><input type="radio" name="p[now]" value="+" title="p+"></td>
<td><input type="radio" name="p[fut]" value="+" title="p+"></td>
<td>Two or three conventional pets (cats, dogs, etc), or one fairly exotic one</td>
</tr>
<tr>
<td><input type="radio" name="p[now]" value=" " title="p "></td>
<td><input type="radio" name="p[fut]" value=" " title="p "></td>
<td>One pet of a fairly conventional type (cat, dog, etc)</td>
</tr>
<tr>
<td><input type="radio" name="p[now]" value="-" title="p-"></td>
<td><input type="radio" name="p[fut]" value="-" title="p-"></td>
<td>No pets currently, but I may enrich my life in the future</td>
</tr>
<tr>
<td><input type="radio" name="p[now]" value="--" title="p--"></td>
<td><input type="radio" name="p[fut]" value="--" title="p--"></td>
<td>I don't have any pets; my lifestyle/household/schedule is complicated enough already</td>
</tr>
<tr>
<td><input type="radio" name="p[now]" value="---" title="p---"></td>
<td><input type="radio" name="p[fut]" value="---" title="p---"></td>
<td>I wouldn't have the things in the house [are you sure you're a furry?]</td>
</tr>
<tr>
<td><input type="radio" name="p[now]" value="*" title="p*"></td>
<td><input type="radio" name="p[fut]" value="*" title="p*"></td>
<td>I'd like to have pets, but my landlord/parents/flatmates won't allow them</td>
</tr>
<tr>
<td><input type="radio" name="p[now]" value="**" title="p**"></td>
<td><input type="radio" name="p[fut]" value="**" title="p**"></td>
<td>Sorry, I'm allergic to animals</td>
 </tr>
</tbody>
</table>
</section>
</div>
<div class="inner">
<h2>
<span class="just-icon sectoggle ui-state-default">
<span class="ui-icon ui-icon-carat-1-s"></span>
<span class="sechead" id="s">Human Sex</span>
</span>
<span class="btns">
<span class="bset">
<input type="radio" name="s[now][opt]" value="" data-clear="1">
<input type="radio" name="s[now][opt]" value="?">
<input type="radio" name="s[now][opt]" value="~">
<input type="radio" name="s[now][opt]" value="!">
<input type="radio" name="s[now][opt]" value="#">
</span>
<input type="checkbox" name="s[now][opt]" value="$">
</span>
</h2>
<section>
<p>Use this code, if you wish, to describe the sex (and sex life) of your human persona. As with the furry sex code, you should feel free to use the <em>#</em> ("mind your own business") or <em>!</em> ("nothing to do with me") modifiers if you prefer.</p>
<p>First, which sex are you?</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="s[now][pmod]" value=""></th>
<th><input type="radio" name="s[fut][pmod]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="s[now][pmod]" value="f" title="sf"></td>
<td><input type="radio" name="s[fut][pmod]" value="f" title="sf"></td>
<td>Female</td>
</tr>
<tr>
<td><input type="radio" name="s[now][pmod]" value="m" title="sm"></td>
<td><input type="radio" name="s[fut][pmod]" value="m" title="sm"></td>
<td>Male</td>
</tr>
</tbody>
</table>
<p>If you wish to reveal any details of your sex life, use one of these codes:</p>
<table class="codetbl">
<thead>
<tr>
<th class="c_now">Now</th>
<th class="c_fut">Future<br><em>(Optional)</em></th>
<th></th>
</tr>
<tr>
<th><input type="radio" name="s[now]" value=""></th>
<th><input type="radio" name="s[fut]" value=""></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="radio" name="s[now]" value="+++" title="s+++"></td>
<td><input type="radio" name="s[fut]" value="+++" title="s+++"></td>
<td>There's more to life? Where is it, and what equipment do you need?</td>
</tr>
<tr>
<td><input type="radio" name="s[now]" value="++" title="s++"></td>
<td><input type="radio" name="s[fut]" value="++" title="s++"></td>
<td>I was once referred to as "easy", but I have no idea where that might have come from</td>
</tr>
<tr>
<td><input type="radio" name="s[now]" value="+" title="s+"></td>
<td><input type="radio" name="s[fut]" value="+" title="s+"></td>
<td>I've had real, live sex</td>
</tr>
<tr>
<td><input type="radio" name="s[now]" value=" " title="s "></td>
<td><input type="radio" name="s[fut]" value=" " title="s "></td>
<td>I've had sex ... oh, you mean with someone else?</td>
</tr>
<tr>
<td><input type="radio" name="s[now]" value="-" title="s-"></td>
<td><input type="radio" name="s[fut]" value="-" title="s-"></td>
<td>Not having sex by choice</td>
</tr>
<tr>
<td><input type="radio" name="s[now]" value="--" title="s--"></td>
<td><input type="radio" name="s[fut]" value="--" title="s--"></td>
<td>Not having sex because I can't get any</td>
</tr>
<tr>
<td><input type="radio" name="s[now]" value="---" title="s---"></td>
<td><input type="radio" name="s[fut]" value="---" title="s---"></td>
<td>Not having sex because I'm a nun/priest</td>
</tr>
<tr>
<td><input type="radio" name="s[now]" value="*" title="s*"></td>
<td><input type="radio" name="s[fut]" value="*" title="s*"></td>
<td>I'm married, so I can get it whenever I want (well, that's the theory, anyway)</td>
</tr>
<tr>
<td><input type="radio" name="s[now]" value="**" title="s**"></td>
<td><input type="radio" name="s[fut]" value="**" title="s**"></td>
<td>I have a few little rug rats to prove I've been there (but with kids around, who has time for sex?)</td>
</tr>
</tbody>
</table>
</section>
</div>
</div>
<div class="outer">
<h1>Notes</h1>
<div class="inner">
<h2>Currently Unsupported Features</h2>
<ul>
<li>There's currently no way of giving multiple answers to a section, e.g. <em>FCF/FX</em> for "sometimes a fox; sometimes a lynx".</li>
<li>One code cannot currently detail multiple characters (e.g. <em>FCWh4dm/CF3c/UGm6s</em>).</li>
<li>No way of specifying multiple Real Life jobs/training.</li>
</ul>
</div>
<div class="inner">
<h2>To-Do List</h2>
<ul>
<li>Add a button to load in a code for modification.</li>
<li>Allow unsure/approx/professional buttons to be selected separately for now &amp; future.</li>
</ul>
</div>
</div>
<footer>
<table>
<tbody>
<tr>
<td style="width:10px;white-space:nowrap;"><h1>Your Code:</h1></td>
<td><textarea id="output" rows="2" cols="80"></textarea></td>
</tr>
</tbody>
</table>
</footer>
<div style="position:fixed;bottom:0px;right:0px;font-size:0.6em;">0.0034 s / 0.31 MiB</div>
<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="cdef8ac64033727dc743dca7-|49" defer=""></script></body>
</html>