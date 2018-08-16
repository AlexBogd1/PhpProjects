<!doctype html>
<!--[if lte IE 9]>         <html lang="en" class="lt-ie10 lt-ie10-msg no-focus"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en" class="no-focus"> <!--<![endif]-->
     <?php
     session_start();
        if(	!isset($_SESSION['a'])){
            exit(header('Location:/index.html'));
        }
    ?> 
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        

        <title>Санаториум - Показатели продаж</title>

        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="robots" content="noindex, nofollow">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="assets/img/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="assets/img/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <!-- Stylesheets -->
        <!-- Codebase framework -->
        <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->
        
    </head>
    <body>
            
        <!-- Page Container -->
        <!--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Codebase() -> uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-inverse'                           Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header

        HEADER STYLE

            ''                                          Classic Header style if no class is added
            'page-header-modern'                        Modern Header style
            'page-header-inverse'                       Dark themed Header (works only with classic Header style)
            'page-header-glass'                         Light themed Header with transparency by default
                                                        (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
            'page-header-glass page-header-inverse'     Dark themed Header with transparency by default
                                                        (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        -->
        <div id="page-container" class="side-scroll sidebar-inverse page-header-fixed">
            <!-- Side Overlay-->
            <!-- END Side Overlay -->

            <!-- Sidebar -->
            <!--
                Helper classes

                Adding .sidebar-mini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
                Adding .sidebar-mini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                    If you would like to disable the transition, just add the .sidebar-mini-notrans along with one of the previous 2 classes

                Adding .sidebar-mini-hidden to an element will hide it when the sidebar is in mini mode
                Adding .sidebar-mini-visible to an element will show it only when the sidebar is in mini mode
                    - use .sidebar-mini-visible-b if you would like to be a block when visible (display: block)
            -->
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">

			
                    <!-- Right Section -->
                    <div class="content-header-section">
                        <!-- User Dropdown -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dashboard Санаториум<i class="fa fa-angle-down ml-5"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-user-dropdown">
                                <a class="dropdown-item" href="index.html">
                                    <i class="si si-logout mr-5"></i> Выход
                                </a>
                            </div>
                        </div>
                        <!-- END User Dropdown -->

                        <!-- Toggle Side Overlay -->
                        <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->



                <!-- Header Loader -->
                <div id="page-header-loader" class="overlay-header bg-primary">
                    <div class="content-header content-header-fullrow text-center">
                        <div class="content-header-item">
                            <i class="fa fa-sun-o fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="content bg-black-op-6">
                    <div class="row">
                        <!-- Row #2 -->
						<div class="col-md-6">
					<div class="row col-md-12 col-xl-12">
					<div class="col-6 col-sm-4">
							<a class="block block-link-shadow" href="javascript:void(0)">
								<div class="block-content block-content-full text-right">
									<div id="sumtodaypay" class="font-size-h2 font-w700">N/A</div>
										<div class="font-size-sm font-w600 text-uppercase text-muted">Оборот сегодня</div>
								</div>
							</a>
						</div>
						<div class="col-6 col-sm-4">
							<a class="block block-link-shadow" href="javascript:void(0)">
								<div class="block-content block-content-full text-right">
									<div id="summonthypay" class="font-size-h2 font-w700">N/A</div>
										<div class="font-size-sm font-w600 text-uppercase text-muted">Оборот за месяц</div>
								</div>
							</a>
						</div>
						<div class="col-6 col-sm-4">
							<a class="block block-link-shadow" href="javascript:void(0)">
								<div class="block-content block-content-full text-right">
									<div id="time" class="font-size-h2 font-w700">XX:XX:XX</div>
										<div class="font-size-sm font-w600 text-uppercase text-muted">Последнее обновление</div>
								</div>
							</a>
						</div>
					</div>
                        <div class="col-md-12">
                            <div class="block block-bordered block-rounded block block-themed">
                                <div class="block-header block-header-default border-b bg-gd-emerald">
                                    <h3 class="block-title">
                                        Итого заявок
                                    </h3>
                                    <div class="block-options">
                                    </div>
                                </div>
                                <div class="block-content bg-body">
                                    <div class="row gutters-tiny items-push text-center">
                                        <div class="col-6 col-sm-4">
                                            <div id="countleadsthisday" class="font-size-h4 font-w600">N/A</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">Сегодня</div>
                                        </div>
                                        <div class="col-6 col-sm-4">
                                            <div id="countleadsyesterday" class="font-size-h4 font-w600">N/A</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">Вчера</div>
                                        </div>
                                        <div class="col-6 col-sm-4">
                                            <div id="countleadsthismonth" class="font-size-h4 font-w600">N/A</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">В этом месяце</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-md-12">
                            <div class="block block-bordered block-rounded block block-themed">
                                <div class="block-header block-header-default border-b bg-gd-emerald">
                                    <h3 class="block-title">
                                        Итого договоров
                                    </h3>
                                    <div class="block-options">
                                    </div>
                                </div>
                                <div class="block-content bg-body">
                                    <div class="row items-push text-center">
                                        <div class="col-6 col-sm-4">

                                            <div id="counttodaycontracts" class="font-size-h4 font-w600">N/A</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">Сегодня</div>
                                        </div>
                                        <div class="col-6 col-sm-4">
                                            <div id="countyesrerdaycontracts" class="font-size-h4 font-w600">N/A</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">Вчера</div>
                                        </div>
                                        <div class="col-6 col-sm-4">
                                            <div id="countmonthcontracts" class="font-size-h4 font-w600">N/A</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">В этом месяце</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-md-12">
                            <div class="block block-bordered block-rounded block block-themed">
                                <div class="block-header block-header-default border-b bg-gd-emerald">
                                    <h3 class="block-title">
                                        Итого оплат
                                    </h3>
                                    <div class="block-options">
                                    </div>
                                </div>
                                <div class="block-content bg-body">
                                    <div class="row items-push text-center">
                                        <div class="col-6 col-sm-4">
                                            <div id="counttodaypay" class="font-size-h4 font-w600">N/A</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">Сегодня</div>
                                        </div>
                                        <div class="col-6 col-sm-4">
                                            <div id="countyesterdaypay" class="font-size-h4 font-w600">N/A</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">Вчера</div>
                                        </div>
                                        <div class="col-6 col-sm-4">
                                            <div id="countmonthypay" class="font-size-h4 font-w600">N/A</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">В этом месяце</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="row col-md-6 col-xl-6">
					<div class="col-12 block-themed">
						<div class="block block-bordered block-rounded block-themed">
							<div class="block-header block-header-default border-b bg-gd-emerald">
                                    <h3 class="block-title">
                                        Рейтинг менеджеров по текущему месяцу
                                    </h3>
                                    <div class="block-options">
                                    </div>
                                </div>
							<div  class="table-responsive">
							<table id = "manager" class="table table-striped table-vcenter">
							<thead>
							<tr >
								<th>ИМЯ</th>
								<th style="width: 30%;">Количество оплат, ед.</th>
								<th style="width: 30%;">Выручка, руб.</th>
							</tr>
							</thead>
<!--							<tbody>
                             <tr>
                            <td class="font-w600">Менеджер 1</td>
                            <td>XX</td>
							<td>XX</td>
							</tr>
                                            </tbody>-->
                </table>
            </div>
						</div>
						</div>
						</div>
                        <!-- END Row #2 -->
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="opacity-0">
                <div class="content py-20 font-size-xs clearfix">
                    <div class="float-right">
                        Crafted with <i class="fa fa-heart text-pulse"></i> by <a class="font-w600" href="#" target="_blank">Tolstoy</a>
                    </div>
                    <div class="float-left">
                        <a class="font-w600" href="#" target="_blank">Санаториум</a> &copy; <span class="js-year-copy"></span>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->
        <!-- Codebase Core JS -->
        <script src="assets/js/codebase.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="assets/js/plugins/chartjs/Chart.bundle.min.js"></script>
		<script>

var reloadFunction;


	
    reloadFunction = function(){
		$.ajax({
			url:'data.php',
			type:'POST',
			dataType: 'json',
			success: function(data){
					  $("#countleadsthismonth").text(data.countleadsthismonth);
					  $("#countleadsthisday").text(data.countleadsthisday);
					  $("#countleadsyesterday").text(data.countleadsyesterday);
					  $("#counttodaycontracts").text(data.counttodaycontracts);
					  $("#countyesrerdaycontracts").text(data.countyesrerdaycontracts);
					  $("#countmonthcontracts").text(data.countmonthcontracts);
					  $("#counttodaypay").text(data.counttodaypay);
					  $("#countyesterdaypay").text(data.countyesterdaypay);
					  $("#countmonthypay").text(data.countmonthypay);
					  $("#time").text(data.time);
					  $("#sumtodaypay").text(data.sumtodaypay);
					  $("#sumyesterdaypay").text(data.sumyesterdaypay);
					  $("#summonthypay").text(data.summonthypay);
                      
					  console.log(data); 
function setTable(data) {
var expected_keys = { id : false, name : true, sales_sum : true, number_selles : true };

    var tbl_body = '<thead><tr><th>ИМЯ</th><th style="width: 30%;">Количество оплат, руб.</th><th style="width: 30%;">Выручка, ед.</th></tr></thead>';
    var odd_even = false;
    $.each(data, function() {
        var tbl_row = "";
       
        $.each(this, function(k , v) {
		if ( ( k in expected_keys ) && expected_keys[k] ) {
           if(typeof(v)=="number") {
               tbl_row += "<td>"+Number(v).toLocaleString('ru')+"</td>";
           } else {
               tbl_row += "<td>"+v+"</td>";
           }
            
};

        })
        tbl_body += "<tr class=\""+( odd_even ? "odd" : "even")+"\">"+tbl_row+"</tr>";
        
        odd_even = !odd_even;               
    })
    $("table.table").html(tbl_body);
    
}

setTable(data.managerresult);
			}
		});
	};
	reloadFunction();			
	var intevalHandler = setInterval('reloadFunction()',1000);
//};

 
        
  </script>
    </body>
</html>
