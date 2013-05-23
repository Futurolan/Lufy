/**
 * jQuery Pong plugin
 *
 * @name    jquery-pong-0.4.1.js
 * @author  Geoffray Warnants - http://www.geoffray.be
 * @version 0.4.1
 * @date    20100127
 * @example http://www.geoffray.be/lab/pong
 *
 * @todo    Mieux tenir compte des options par défaut (+ initialisaiton via CSS)
 * @todo    Problèmes de positionnement si intégré dans une page avec du contenu
 * @todo    Gérer la fin de la partie
 * @todo    Mieux gérer l'accélération progressive de la difficulté
 */
(function($) {

    $.version = "0.4.1";
    
    $.fn.pong = function(options) {
        
        return $(this).each(function() {
        
            var $this = $(this);
            
            var css_opts = {
                "width":$this.css("width"),
                "height":$this.css("height"),
                "background-color":$this.css("background-color"),
                "border-width":$this.css("border-width"),
                "pad-width":$this.css("border-width"),
                "pad-color":$this.css("color"),
                "ball-size":$this.css("border-width"),
                "ball-color":$this.css("color"),
                "font-family":$this.css("font-family"),
                "font-color":$this.css("color"),
                "border-color":$this.css("color")
            };
            
            var test_opts = $.extend({}, $.fn.pong.defaults, css_opts);
            //console.log(test_opts);
            
            // initialise les options
            var opts = $.extend({}, $.fn.pong.defaults, options);
            
            $this.data("pong_speed", opts.speed);
            $this.data("pong_playing", false);
            $this.data("pong_dx", 1);
            
            initScreen($this,opts);

            $this.data("x_min",$("#"+$this.attr("id")+"_player1").position().left+$("#"+$this.attr("id")+"_player1").width());
            $this.data("x_max",$("#"+$this.attr("id")+"_player2").position().left-$("#"+$this.attr("id")+"_ball").width());
            $this.data("y_min",0);
            $this.data("y_max",$this.height()-$("#"+$this.attr("id")+"_ball").width());

            $this.mousemove(onMousemove);
            $this.click(onClick);
        });
    };
    
    function onMousemove(e)
    {   
        var $this = $(this);
        if ($this.data("pong_playing")) {
            var y_rel = $(window).scrollTop()+(e.clientY-parseInt($this.offset().top));   // y relatif du curseur
            var y = y_rel-parseInt($("#"+$this.attr("id")+"_player1").height()/2);
            if (y<0) {
                y=0;
            } else if (y+$("#"+$this.attr("id")+"_player1").height() > $this.height()){
                y = ($this.height())-$("#"+$this.attr("id")+"_player1").height();
            }
            $("#"+$this.attr("id")+"_player1").css({"top":y});
        }
    };
    
    function onClick(e)
    {
        var $this = $(this);
        if (!$this.data("pong_playing")) {
            $this.data("pong_playing",true);
            $("#"+$this.attr("id")+"_title_box").css({"display":"none"});
            rebondir($this);
        }
    };
    
    function initScreen(obj,opts)
    {
        obj.css({"position":"relative","border-style":"solid","font-family":opts.font_family,"border-width":opts.border_width});
    
        if ((obj.css("background-color"))=="transparent") {
            obj.css({"background-color":opts.background_color});
        }

        if ((obj.css("border-color"))=="") {
            obj.css({"border-color":+opts.border_color});
        }
        
        // Construction de l'écran de jeu
        obj.append($("<div></div>").attr("id",obj.attr("id")+"_player1").css({"position":"absolute","width":opts.pad_width,"height":opts.pad_height,"background-color":opts.pad_color,"left":10,"top":(obj.height()/2)-opts.pad_height/2}));
        obj.append($("<div></div>").attr("id",obj.attr("id")+"_player2").css({"position":"absolute","width":opts.pad_width,"height":opts.pad_height,"background-color":opts.pad_color,"left":obj.width()-20,top:(obj.height()/2)-opts.pad_height/2}));
        obj.append($("<div></div>").attr("id",obj.attr("id")+"_ball").css({"position":"absolute","width":opts.ball_size,"height":opts.ball_size,"background-color":opts.ball_color}));
        obj.append($("<input>").css({"background-color":"transparent","color":obj.css("color"),"border":0,"position":"absolute","text-align":"center","width":100,"font-size":60,"font-weight":"bold","font-family":"Courier,Impact","left":(obj.width()/2)-120}).attr("type","text").attr("id",obj.attr("id")+"_score1").val(0));
        obj.append($("<input>").css({"background-color":"transparent","color":obj.css("color"),"border":0,"position":"absolute","text-align":"center","width":100,"font-size":60,"font-weight":"bold","font-family":"Courier,Impact","left":(obj.width()/2)+20}).attr("type","text").attr("id",obj.attr("id")+"_score2").val(0));

        obj.append(
            $("<div></div>").attr("id",obj.attr("id")+"_title_box").css({"position":"absolute","color":obj.css("color"),"text-align":"center","font-weight":"bold","width":obj.width(),"height":150,"top":(obj.height()/2)-75})
                .append(
                    $("<div></div>").attr("id",obj.attr("id")+"_title").css({"font-size":100}).html("jPong"))
                .append(
                    $("<div></div>")
                    .attr("id",obj.attr("id")+"_title_msg").css({"font-size":15})
                    .append($("<span></span>").html("v"+$.version))
                    .append($("<a></a>").attr("href","http://www.geoffray.be").css({"color":obj.css("color"),"text-decoration":"none","margin-left":5}).html("Geoffray Warnants"))
                    
            )
        );
    }
    
    function moveComputer($this,yc) {
    
        if (yc<0) {
            yc=0;
        } else if (yc>$this.height()-$("#"+$this.attr("id")+"_player2").height()) {
            yc = $this.height()-$("#"+$this.attr("id")+"_player2").height();
        }
        $("#"+$this.attr("id")+"_player2").stop().animate({"top":yc},400,"linear");
    }
    
    function rebondir($this) {

        var speed = $this.data("pong_speed");        
        var dx = $this.data("pong_dx");
        var x = $this.data((dx==1) ? "x_max" : "x_min"); 
        var y = Math.floor($this.data("y_min")+Math.random()*$this.data("y_max")-$this.data("y_min"));
        
        $("#"+$this.attr("id")+"_ball").animate({"left":x,"top":y},speed,"linear",function(){
            $this.data("pong_dx", 0-$this.data("pong_dx"));
            if (dx==-1) {
                
                var y_min = parseInt($("#"+$this.attr("id")+"_player1").css("top"))-$("#"+$this.attr("id")+"_ball").height();
                var y_max = y_min+$("#"+$this.attr("id")+"_player1").height()+$("#"+$this.attr("id")+"_ball").height();
                if (y > y_min && y < y_max) {
                    $this.data("pong_speed", speed-50);
                } else {
                    $this.data("pong_playing", false);
                    $("#"+$this.attr("id")+"_score2").val(parseInt($("#"+$this.attr("id")+"_score2").val())+1);
                    
                    if ($("#"+$this.attr("id")+"_score2").val() >= 5) {
                        $("#"+$this.attr("id")+"_title").html("You loose");
                        $("#"+$this.attr("id")+"_title_msg").html("");
                        $("#"+$this.attr("id")+"_title_box").css({"display":"block"});
                    }
                    
                }
                
            } else {
            
                var y_min = parseInt($("#"+$this.attr("id")+"_player2").css("top"))-$("#"+$this.attr("id")+"_ball").height();
                var y_max = y_min+$("#"+$this.attr("id")+"_player2").height()+$("#"+$this.attr("id")+"_ball").height();
                if (y > y_min && y < y_max) {
                    $this.data("pong_speed", speed-50);
                } else {
                    $this.data("pong_playing", false);
                    $("#"+$this.attr("id")+"_score1").val(parseInt($("#"+$this.attr("id")+"_score1").val())+1);
                    $("#"+$this.attr("id")+"_player2").stop();
                    if ($("#"+$this.attr("id")+"_score1").val() >= 5) {
                        $("#"+$this.attr("id")+"_title").html("You win");
                        $("#"+$this.attr("id")+"_title_msg").html("");
                        $("#"+$this.attr("id")+"_title_box").css({"display":"block"});
                    }
                }
            }
            
            if ($this.data("pong_playing")) {
                rebondir($this);
            }
            
        });
        
        if ($this.data("pong_playing")) {
            window.setTimeout(function() {
                moveComputer($this,((dx==1) ? y : $this.height()/2) - $("#"+$this.attr("id")+"_player2").height()/2);
            }, Math.round((500-(2*speed))+Math.random()*(1000-(2*speed))));
        }
    }

    // Valeurs par défaut des options
    $.fn.pong.defaults = {
        "width": 640,                    // Largeur de l'écran de jeu
        "height": 480,                   // Hauteur de l'écran de jeu
        "background_color": "#ffffff",   // Couleur d'arrière plan
        "border_width": 10,              // Largeur des bordures
        "pad_width": 10,                 // Largeur des paddles
        "pad_height": 100,               // Hauteur des paddles
        "pad_color": "#333333",          // Couleur des paddles
        "ball_size": 10,                 // Taille de la balle
        "ball_color": "#333333",         // Couleur de la balle
        "font_family": "Courier,Impact", // Police
        "font_color": "#333333",         // Couleur du texte
        "border_color": "#333333",       // Couleur des bordures de l'écran de jeu
        "speed": 2000                    // Vitesse de la balle
    };

})(jQuery);
