<head>
    <meta charset="utf-8"/>
    <title>Service scolarité - Attribution des conseillers à l'UTT</title>
    <link href='http://fonts.googleapis.com/css?family=Vollkorn:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="public/js/jquery-2.1.1.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
    		var	x=1;
			$(".flip").click(function(){
    			$("div #panel").slideToggle();
    			if (x==1) {
    				$("#f1").hide();
    				x=0;
    			}else{
    				$("#f1").show();
    				x=1;
    			};
  			});
		});
    </script>
</head>