<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400,300' rel='stylesheet' type='text/css'> -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:100,300' rel='stylesheet' type='text/css'>
    <meta name="description" content="Jordi Pont-Tuset and Ferran Marques. SEISM, Supervised Evaluation of Image Segmentation Methods.">

    <title>SEISM &ndash; Supervised Evaluation of Image Segmentation Methods</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/side-menu-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="css/layouts/side-menu.css">
    <!--<![endif]-->
    
    <!--Includes-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <style type="text/css">

      .boxTitle {
        font-size: 90%;
        margin-top: 15px;
        margin-bottom: 2px;
      }

      .boxInner img {
        width: 95%;
      }

      .boxInnerBorder img {
        width: 95%;
        outline: 1px solid black;
        outline-offset: -1px;
      }

    </style>
</head>


<body>
<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pure-menu">

            <ul class="pure-menu-list">
                <li><a href="index.html" class="pure-menu-link">Home</a></li>
                <li><a href="soa_compare.php" class="pure-menu-link">Benchmark SoA</a></li>
                <li><a class="pure-menu-link pure-menu-selected">Explore SoA</a></li>
                <li><a href="code.html" class="pure-menu-link">Code</a></li>
                <li><a href="contact.php" class="pure-menu-link">Contact</a></li>
            </ul>
        </div>
    </div>

    <div id="main">
        <div class="header">
            <h1>Explore the State of the Art</h1>
            <h2>Browse all partitions from the studied techniques</h2>
        </div>

        <div class="pure-g">
            <div class="pure-u-1-1" style="font-family: 'Raleway', sans-serif; margin-top: 30px;margin-left: 15%;margin-right: 15%;">
              <center>Partitions from all studied techniques selected at Optimal Dataset Scale (ODS) and Optimal Image Scale (OIS), with respect to Fb and Fop. <a href="browse.php">To go back, click here.</a></center>
            </div>
            <div class="pure-u-1-4" style="font-family: 'Raleway', sans-serif;">
            </div>
            <div class="pure-u-1-4" style="font-family: 'Raleway', sans-serif;">
              <center id="image"></center>
            </div>
            <div class="pure-u-1-4" style="font-family: 'Raleway', sans-serif;">
              <center id="gt"></center>
            </div>
            <div class="pure-u-1-4" style="font-family: 'Raleway', sans-serif;">
            </div>
        </div>

        <div id="res_container" class="pure-g" style="margin-bottom: 50px;">

        </div>

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script type="text/javascript">
        $(function(){
             // See if this is a touch device
             if ('ontouchstart' in window)
             {
                // Set the correct body class
                $('body').removeClass('no-touch').addClass('touch');
               
                // Add the touch toggle to show text
                $('div.boxInner img').click(function(){
                   $(this).closest('.boxInner').toggleClass('touchFocus');
                });
             }
        });
        </script>

        <script type="text/javascript">
            im_horiz = ["100007","100039","100099","10081","101027","102062","103006","103029","103078","105027","106005","106047","107014","107045","107072","108004","108036","108069","109055","112056","112090","118015","118031","118072","120003","120093","123057","128035","130066","134049","14085","14092","141012","141048","145059","145079","146074","147080","15011","15062","157032","157087","159022","160006","16004","160067","16068","161045","168084","175083","176051","179084","183066","185092","187058","187099","188025","189096","196062","196088","201080","202000","206062","206097","207038","207049","208078","209021","217090","220003","223060","226022","226033","228076","232076","235098","247003","247012","253016","258089","268048","277053","28083","285022","288024","290035","29030","296028","296058","306052","3063","309040","317043","326025","335088","335094","344010","346016","35028","35049","36046","368037","376086","384022","385022","393035","41006","41029","41085","41096","43033","43051","45000","48017","48025","49024","5096","51084","69000","69007","69022","70011","71099","77062","78098","79073","80085","8068","81066","81095","87015","92014","94095","97010"];
            im_verti = ["101084","104010","104055","117025","130014","134067","140006","140088","147077","156054","159002","163004","163096","164046","17067","181021","189006","189013","189029","196027","196040","198087","20069","2018","217013","223004","225022","226043","226060","230063","230098","23050","238025","243095","246009","249021","250047","250087","253092","257098","259060","267036","268074","279005","281017","289011","302022","306051","326085","33044","334025","347031","365072","372019","384089","388006","388018","388067","6046","61034","64061","65084","70090","71076","80090","81090"];
        
            var techniques = [{name:"human"   , displayname:"Ground Truth", mysqlname: "human"},
                              {name:"LEP"     , displayname:"LEP"         , mysqlname: "LEP"},
                              {name:"MCG"     , displayname:"MCG"         , mysqlname: "MCG"},
                              {name:"gPb-UCM" , displayname:"gPb-UCM"     , mysqlname: "gPbUCM"},
                              {name:"ISCRA"   , displayname:"ISCRA"       , mysqlname: "ISCRA"},
                              {name:"NCut"    , displayname:"NCut"        , mysqlname: "NCut"},
                              {name:"EGB"     , displayname:"EGB"         , mysqlname: "EGB"},
                              {name:"MShift"  , displayname:"MShift"      , mysqlname: "MShift"},
                              {name:"IIDKL"   , displayname:"IIDKL"       , mysqlname: "IIDKL"},
                              {name:"NWMC"    , displayname:"NWMC"        , mysqlname: "NWMC"},
                              //{name:"SMaps"   , displayname:"SMaps"       , mysqlname: "SMaps"},
                              {name:"QuadTree", displayname:"QuadTree"    , mysqlname: "QuadTree"}];

            function show_header_result(im_id)
            {
              // if (im_horiz.indexOf(im_id) > -1)
              document.getElementById("image").innerHTML = '<div class="boxTitle">Id '+im_id+'</div><div class="boxInner"><img src="data/bsds500/'+ im_id +'.jpg"/></div>'
              document.getElementById("gt").innerHTML = '<div class="boxTitle">Ground Truth</div><div class="boxInnerBorder"><img src="data/partitions/human/'+ im_id +'.png"/></div>'
            }

            function show_one_result(techn,im_id,ods_ois)
            {
              // Parse the ods and ois
              var ods_ois_split = ods_ois.split("-")

              // Show the images
              document.getElementById("res_container").innerHTML = document.getElementById("res_container").innerHTML +
               `<div class="pure-g" style="margin-top: 20px;margin-left: 5%;margin-right: 5%;">
                  <div class="pure-u-1-4" style="font-family: 'Raleway', sans-serif;">
                    <center>
                      <div class="boxTitle">`+techn.name +` - Fb ODS (` + ods_ois_split[0] + `)</div>
                      <div class="boxInnerBorder"><img src="data/partitions/`+ techn.name + `/`+ im_id +`_fb_ods.png"/></div>
                    </center>
                  </div>
                  <div class="pure-u-1-4" style="font-family: 'Raleway', sans-serif;">
                    <center>
                      <div class="boxTitle">`+techn.name +` - Fb OIS (` + ods_ois_split[1] + `)</div>
                      <div class="boxInnerBorder"><img src="data/partitions/`+ techn.name + `/`+ im_id +`_fb_ois.png"/></div>
                    </center>
                  </div>
                  <div class="pure-u-1-4" style="font-family: 'Raleway', sans-serif;">
                   <center>
                      <div class="boxTitle">`+techn.name +` - Fop ODS (` + ods_ois_split[2] + `)</div>
                      <div class="boxInnerBorder"><img src="data/partitions/`+ techn.name + `/`+ im_id +`_fop_ods.png"/></div>
                   </center>
                  </div>
                  <div class="pure-u-1-4" style="font-family: 'Raleway', sans-serif;">
                    <center>
                      <div class="boxTitle">`+techn.name +` - Fop OIS (` + ods_ois_split[3] + `)</div>
                      <div class="boxInnerBorder"><img src="data/partitions/`+ techn.name + `/`+ im_id +`_fop_ois.png"/></div>
                    </center>
                  </div>
                </div>`;
            }



            // Get image id from the PHP url if set
            var im_id = '<?php 
              if (isset($_GET['im_id']))
              {
                $im_id=$_GET['im_id'];
                echo $im_id;
              }
              else
              {
                echo "100007";
              }
              ?>';

            // Display the header
            show_header_result(im_id)

            // Get the ODS and OIS from mySQL
            $.when($.get('search.php',{ 'get_ods_ois' : im_id }))
             .done(function( data )
            {
              // Decode the JSON string
              var ods_ois = JSON.parse(data);

              // Call the actual code to show the images            
              for (var i=1; i<techniques.length; i++)
                show_one_result(techniques[i], im_id, ods_ois[techniques[i].mysqlname])      

            });
        </script>
    </div>
</div>





<script src="js/ui.js"></script>
    

</body>

</html>


