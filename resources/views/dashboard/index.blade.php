@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
    	@if(Auth::user()->roles == "Supervisor")
        <div class="row">
            <div class="col-md-4">
                <div class="card card-chart">
					<div class="card-header card-header-icon card-header-danger">
						<div class="card-icon">
							<i class="material-icons">pie_chart</i>
						</div>
						<h4 class="card-title">Work By ID Project</h4>
					</div>
					<div class="card-body">
						<div id="chartWorkManager" class="ct-chart"></div>
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<h6 class="card-category">Legend</h6>
							</div>
							<div class="col-md-12" id="chartWorkLegendManager"></div>
						</div>
					</div>
				</div>
            </div>
            <div class="col-md-4">
                <div class="card">
					<div class="card-header card-header-icon card-header-rose">
						<div class="card-icon">
							<i class="material-icons">insert_chart</i>
						</div>
						<h4 class="card-title">Work By ID Project
							<small>- Bar Chart</small>
						</h4>
					</div>
					<div class="card-body">
						<div id="multipleBarsChartManager" class="ct-chart"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
                <div class="card card-chart">
					<div class="card-header card-header-icon card-header-danger">
						<div class="card-icon">
							<i class="material-icons">pie_chart</i>
						</div>
						<h4 class="card-title">Site Chart</h4>
					</div>
					<div class="card-body">
						<div id="chartSiteManager" class="ct-chart"></div>
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<h6 class="card-category">Legend</h6>
							</div>
							<div class="col-md-12" id="chartSiteLegendManager">
								
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-icon card-header-info">
						<div class="card-icon">
							<i class="material-icons">timeline</i>
						</div>
						<h4 class="card-title">Overal Mandays
							<small> - Rounded</small>
						</h4>
					</div>
					<div class="card-body">
						<div id="chartOveralMandaysManager" class="ct-chart"></div>
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<h6 class="card-category">Legend</h6>
							</div>
							<div class="col-md-12" id="chartOveralMandaysLegendManager">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4" style="display:none">
				<div class="card">
					<div class="card-header card-header-icon card-header-info">
						<div class="card-icon">
							<i class="material-icons">timeline</i>
						</div>
						<h4 class="card-title">Monthly Mandays
							<small> - Rounded</small>
						</h4>
					</div>
					<div class="card-body">
						<div id="chartMonthMandaysManager" class="ct-chart"></div>
					</div>
				</div>
			</div>
        </div>
        @else
        <div class="row">
            <div class="col-md-4">
                <div class="card card-chart">
					<div class="card-header card-header-icon card-header-danger">
						<div class="card-icon">
							<i class="material-icons">pie_chart</i>
						</div>
						<h4 class="card-title">Work By ID Project</h4>
					</div>
					<div class="card-body">
						<div id="chartWork" class="ct-chart"></div>
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<h6 class="card-category">Legend</h6>
							</div>
							<div class="col-md-12" id="chartWorkLegend"></div>
						</div>
					</div>
				</div>
            </div>
            <div class="col-md-4">
                <div class="card">
					<div class="card-header card-header-icon card-header-rose">
						<div class="card-icon">
							<i class="material-icons">insert_chart</i>
						</div>
						<h4 class="card-title">Work By ID Project
							<small>- Bar Chart</small>
						</h4>
					</div>
					<div class="card-body">
						<div id="multipleBarsChart" class="ct-chart"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
                <div class="card card-chart">
					<div class="card-header card-header-icon card-header-danger">
						<div class="card-icon">
							<i class="material-icons">pie_chart</i>
						</div>
						<h4 class="card-title">Site Chart</h4>
					</div>
					<div class="card-body">
						<div id="chartSite" class="ct-chart"></div>
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<h6 class="card-category">Legend</h6>
							</div>
							<div class="col-md-12" id="chartSiteLegend">
								
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
				<div class="card">
					<div class="card-header card-header-icon card-header-info">
						<div class="card-icon">
							<i class="material-icons">timeline</i>
						</div>
						<h4 class="card-title">Overal Mandays
							<small> - Rounded</small>
						</h4>
					</div>
					<div class="card-body">
						<div id="chartOveralMandays" class="ct-chart"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header card-header-icon card-header-info">
						<div class="card-icon">
							<i class="material-icons">timeline</i>
						</div>
						<h4 class="card-title">Monthly Mandays
							<small> - Rounded</small>
						</h4>
					</div>
					<div class="card-body">
						<div id="chartMonthMandays" class="ct-chart"></div>
					</div>
				</div>
			</div>
        </div>
        @endif
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
    	var dataByIdProject;
    	var dataBySite;
        var dataByIdProjectYear;
        var dataOveralMandays;
        var dataMonthlyMandays;

        var optionsPreferences = {
            height: '230px'
        };

        var optionsMultipleBarsChart = {
            seriesBarDistance: 10,
            axisX: {
                showGrid: false
            },
            height: '300px'
        };

        var responsiveOptionsMultipleBarsChart = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function(value) {
                        return value[0];
                    }
                }
            }]
        ];

		var high = "{{Auth::user()->roles}}" == "Supervisor" ? 100 : 25
		var height = "{{Auth::user()->roles}}" == "Supervisor" ? "600px" : "300px"

		var optionsColouredRoundedLineChart = {
			lineSmooth: Chartist.Interpolation.cardinal({
				tension: 10
			}),
			axisY: {
				showGrid: true,
				offset: 40
			},
			axisX: {
				showGrid: false,
			},
			low: 0,
			high: high,
			showPoint: true,
			height: height
		};

		var optionsColouredRoundedLineChart2 = {
			lineSmooth: Chartist.Interpolation.cardinal({
				tension: 10
			}),
			axisY: {
				showGrid: true,
				offset: 40
			},
			axisX: {
				showGrid: false,
			},
			low: 0,
			high: 10,
			showPoint: true,
			height: height
		};

		var requestType = "{{Auth::user()->roles}}" == "Supervisor" ? "Manager" : "Non-Manager"

		$.ajax({
    		url:"{{url('dashboard/getData')}}",
    		data:{
    			type:requestType,
    		},
    		success:function(result){
    			dataByIdProject = {
    				labels : result["dataByIdProject"]["series"],
    				series : result["dataByIdProject"]["series"]
    			}

    			dataBySite = {
    				labels : result["dataBySite"]["series"],
    				series : result["dataBySite"]["series"]
    			}

    			dataByIdProjectYear = {
    				labels: result["dataByIdProjectYear"]["label"],
		            series: result["dataByIdProjectYear"]["series"]
    			}

				dataOveralMandays = {
					labels: result["dataOveralMandays"]["label"],
					series: result["dataOveralMandays"]["series"]
				}

				dataMonthlyMandays = {
					labels: result["dataMonthlyMandays"]["label"],
					series: result["dataMonthlyMandays"]["series"]
				}

    			if("{{Auth::user()->roles}}" == "Supervisor"){
					Chartist.Pie('#chartWorkManager', dataByIdProject, optionsPreferences);
					Chartist.Pie('#chartSiteManager', dataBySite, optionsPreferences);
					var multipleBarsChart = Chartist.Bar('#multipleBarsChartManager', dataByIdProjectYear, optionsMultipleBarsChart, responsiveOptionsMultipleBarsChart);
					var chartOveralMandays = new Chartist.Line('#chartOveralMandaysManager', dataOveralMandays, optionsColouredRoundedLineChart);
					var chartMonthMandays = new Chartist.Line('#chartMonthMandaysManager', dataMonthlyMandays, optionsColouredRoundedLineChart2);
					$.each(result["dataByIdProject"]["label"],function(key,value){
			    		$("#chartWorkLegendManager").append('<i class="fa fa-circle" style="color:' + result["dataByIdProject"]["color"][key] + '"></i> ' + value)
			    	})
			    	$.each(result["dataBySite"]["label"],function(key,value){
			    		$("#chartSiteLegendManager").append('<i class="fa fa-circle" style="color:' + result["dataByIdProject"]["color"][key] + '"></i> ' + value)
			    	})
			    	$.each(result["dataOveralMandays"]["legend"],function(key,value){
			    		$("#chartOveralMandaysLegendManager").append('<i class="fa fa-circle" style="color:' + result["dataByIdProject"]["color"][key] + '"></i> ' + value)
			    	})
				} else {
					$.each(result["dataByIdProject"]["label"],function(key,value){
			    		$("#chartWorkLegend").append('<i class="fa fa-circle" style="color:' + result["dataByIdProject"]["color"][key] + '"></i> ' + value)
			    	})
			    	$.each(result["dataBySite"]["label"],function(key,value){
			    		$("#chartSiteLegend").append('<i class="fa fa-circle" style="color:' + result["dataByIdProject"]["color"][key] + '"></i> ' + value + " ")
			    	})
					Chartist.Pie('#chartWork', dataByIdProject, optionsPreferences);
					Chartist.Pie('#chartSite', dataBySite, optionsPreferences);
					var multipleBarsChart = Chartist.Bar('#multipleBarsChart', dataByIdProjectYear, optionsMultipleBarsChart, responsiveOptionsMultipleBarsChart);
					var chartOveralMandays = new Chartist.Line('#chartOveralMandays', dataOveralMandays, optionsColouredRoundedLineChart);
					var chartMonthMandays = new Chartist.Line('#chartMonthMandays', dataMonthlyMandays, optionsColouredRoundedLineChart2);
				}
		        
		        md.startAnimationForBarChart(multipleBarsChart);
				md.startAnimationForLineChart(chartOveralMandays);
				md.startAnimationForLineChart(chartMonthMandays);
    		}
    	})
    })
</script>
@endsection