<?php
// load the functions
require_once("includes/functions.php");

?>
<!DOCTYPE html>
<html>

<?php include "includes/head.php";?>
<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
           
			<?php include 'navbar-header.php' ?>
            <!-- /.navbar-top-links -->
			<?php include 'navbar-top-links.php'; ?>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
						<?php include 'includes/run_check.php';?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Current Data Summary - run: <?php echo cleanname($_SESSION['active_run_name']);; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<ul class="nav nav-pills">
			  <li><a href="current_summary.php">Read Summaries</a></li>
			  <li><a href="current_histogram.php">Read Histograms</a></li>
			  <li ><a href="current_rates.php">Sequencing Rates</a></li>
			  <li ><a href="current_pores.php">Pore Activity</a></li>
  			  <li class="active"><a href="current_quality.php">Read Quality</a></li>
  			  <li><a href="current_coverage.php">Coverage Detail</a></li>
			</ul>
			
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title"><!-- Button trigger modal -->
<button class="btn btn-info" data-toggle="modal" data-target="#modal4">
 <i class="fa fa-info-circle"></i> Quality Information</h4>
</button>

<!-- Modal -->
			<div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="myModalLabel"> Quality Information</h4>
			      </div>
			      <div class="modal-body">
			        Read Quality Over Length<br>
					This plot shows the average quality of each position of every read which maps to the reference.<br><br>
			        Read Number Over Length<br>
					This plot shows the numbers of reads at each length which align.<br><br>
					Read Quality For 100 Random Reads<br>
		This plot shows the average quality for 1000 random reads from the run. Note that the 100 reads are not the same for the three classes of read.
		  </div>
					  </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>
				
						  <div class="panel-body">
				  			<div id="avgquallength"  style="width:100%; height:400px;"><i class="fa fa-cog fa-spin fa-3x"></i> Calculating Quality Scores for Aligned Reads</div>
				  			<div id="numberoverlength"  style="width:100%; height:400px;"><i class="fa fa-cog fa-spin fa-3x"></i> Calculating Number of Aligned Reads By Length</div>
				  		  	<div id="allqualities"  style="width:100%; height:400px;"><i class="fa fa-cog fa-spin fa-3x"></i> Calculating Quality Scores for 100 Random Reads</div>
				
								  
						</div>
						</div>
						
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	
	
    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Dashboard -->
			    <script type="text/javascript" src="js/pnotify.custom.min.js"></script>
			    <script type="text/javascript">
				PNotify.prototype.options.styling = "fontawesome";
				</script>
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script>
	
	<!-- Highcharts Addition -->
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script type="text/javascript" src="js/themes/grid-light.js"></script>
	<script src="http://code.highcharts.com/4.0.3/modules/heatmap.js"></script>
	<script src="http://code.highcharts.com/modules/exporting.js"></script>
	
	
	<script>
	
$(document).ready(function() {
    var options = {
        chart: {
            renderTo: 'readrate',
			zoomType: 'x'
            //type: 'line'
        },
        title: {
          text: 'Rate Of BaseCalling'
        },
		xAxis: {
		            title: {
		                text: 'Time (S)'
		            }
		        },
				yAxis: {
				            title: {
				                text: 'Reads/Minute'
				            }
				        },
						credits: {
						    enabled: false
						  },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: []
    };
	
    $.getJSON('jsonencode/reads_over_time2.php?prev=0&callback=?', function(data) {
		//alert("success");
        options.series = data; // <- just assign the data to the series property.
        
	 
	
        //options.series = JSON2;
		var chart = new Highcharts.Chart(options);
		});
});

	//]]>  

	</script>
	
	<script>
		
	$(document).ready(function() {
	    var options = {
	        chart: {
	            renderTo: 'averagelength',
				zoomType: 'x'
	            //type: 'line'
	        },
	        title: {
	          text: 'Average Read Length Over Time'
	        },
			xAxis: {
			            title: {
			                text: 'Time (S)'
			            }
			        },
					yAxis: {
					            title: {
					                text: 'Average Read Length'
					            }
					        },
							credits: {
							    enabled: false
							  },
	        legend: {
	            layout: 'vertical',
	            align: 'right',
	            verticalAlign: 'middle',
	            borderWidth: 0
	        },
	        series: []
	    };
	
	    $.getJSON('jsonencode/average_length_over_time.php?prev=0&callback=?', function(data) {
			//alert("success");
	        options.series = data; // <- just assign the data to the series property.
	        
		 
		
	        //options.series = JSON2;
			var chart = new Highcharts.Chart(options);
			});
	});

		//]]>  

		</script>

		<script>
		
	$(document).ready(function() {
	    var options = {
	        chart: {
	            renderTo: 'averagetime',
				zoomType: 'x'
	            //type: 'line'
	        },
	        title: {
	          text: 'Average Time to process Reads Over Time'
	        },
			xAxis: {
			            title: {
			                text: 'Time (S)'
			            }
			        },
					yAxis: {
					            title: {
					                text: 'Average Time To Process Read (s)'
					            }
					        },
							credits: {
							    enabled: false
							  },
	        legend: {
	            layout: 'vertical',
	            align: 'right',
	            verticalAlign: 'middle',
	            borderWidth: 0
	        },
	        series: []
	    };
	
	    $.getJSON('jsonencode/average_time_over_time2.php?prev=0&callback=?', function(data) {
			//alert("success");
	        options.series = data; // <- just assign the data to the series property.
	        
		 
		
	        //options.series = JSON2;
			var chart = new Highcharts.Chart(options);
			});
	});

		//]]>  

		</script>
			<script>
		$(document).ready(function() {
		    var options = {
		        chart: {
		            renderTo: 'activechannels',
					zoomType: 'x'
		            //type: 'line'
		        },
		        title: {
		          text: 'Active Channels Over Time'
		        },
				xAxis: {
				            title: {
				                text: 'Time (S)'
				            }
				        },
						yAxis: {
						            title: {
						                text: 'Number of Active Channels'
						            }
						        },
								credits: {
								    enabled: false
								  },
		        legend: {
		            layout: 'vertical',
		            align: 'right',
		            verticalAlign: 'middle',
		            borderWidth: 0
		        },
		        series: []
		    };
	
		    $.getJSON('jsonencode/active_channels_over_time.php?prev=0&callback=?', function(data) {
				//alert("success");
		        options.series = data; // <- just assign the data to the series property.
	        
		 
		
		        //options.series = JSON2;
				var chart = new Highcharts.Chart(options);
				});
		});

			//]]>  

			</script>
 
			<script>
			$(document).ready(function() {
			    var options = {
			        chart: {
						renderTo: 'poreproduction',
			            type: 'heatmap',
			            marginTop: 40,
			            marginBottom: 40
			        },


			        title: {
			            text: 'Reads Per Pore'
			        },

			        xAxis: {
			            title: null,
						labels: {
						    enabled: false
						  },
						
			        },

			        yAxis: {
			            title: null,
						labels: {
						    enabled: false
						  },
						
			        },
					credits: {
					    enabled: false
					  },
			        colorAxis: {
			            min: 0,
			            minColor: '#FFFFFF',
			            maxColor: Highcharts.getOptions().colors[0]
			        },

			        legend: {
			            align: 'right',
			            layout: 'vertical',
			            margin: 0,
			            verticalAlign: 'top',
			            y: 25,
			            symbolHeight: 320
			        },

			        series: []

			    };
			    $.getJSON('jsonencode/readsperpore.php?prev=0&callback=?', function(data) {
					//alert("success");
			        options.series = data; // <- just assign the data to the series property.
	        
		 
		
			        //options.series = JSON2;
					var chart = new Highcharts.Chart(options);
				});
			});
			</script>
				<script>
			$(document).ready(function() {
			    var options = {
			        chart: {
			            renderTo: 'avgquallength',
						zoomType: 'x'
			            //type: 'line'
			        },
			        title: {
			          text: 'Read Quality Over Length For Aligned Reads'
			        },
					xAxis: {
					            title: {
					                text: 'Basepairs'
					            }
					        },
							yAxis: {
							            title: {
							                text: 'Average Quality Score'
							            }
							        },
									credits: {
									    enabled: false
									  },
			        legend: {
			            layout: 'vertical',
			            align: 'right',
			            verticalAlign: 'middle',
			            borderWidth: 0
			        },
			        series: []
			    };
	
			    $.getJSON('jsonencode/readlengthqual.php?prev=0&callback=?', function(data) {
					//alert("success");
			        options.series = data; // <- just assign the data to the series property.
	        
		 
		
			        //options.series = JSON2;
					var chart = new Highcharts.Chart(options);
					});
			});

				//]]>  

				</script>
					<script>
				$(document).ready(function() {
				    var options = {
				        chart: {
				            renderTo: 'allqualities',
							zoomType: 'x'
				            //type: 'line'
				        },
				        title: {
				          text: 'Read Quality For 100 Random Reads'
				        },
						xAxis: {
						            title: {
						                text: 'Basepairs'
						            }
						        },
								yAxis: {
								            title: {
								                text: 'Average Quality Score'
								            }
								        },
										credits: {
										    enabled: false
										  },
				        legend: {
				            layout: 'vertical',
				            align: 'right',
				            verticalAlign: 'middle',
				            borderWidth: 0
				        },
				        series: []
				    };
	
				    $.getJSON('jsonencode/allqualities.php?prev=0&callback=?', function(data) {
						//alert("success");
				        options.series = data; // <- just assign the data to the series property.
	        
		 
		
				        //options.series = JSON2;
						var chart = new Highcharts.Chart(options);
						});
				});

					//]]>  

					</script>
				<script>
		
				$(document).ready(function() {
				    var options = {
				        chart: {
				            renderTo: 'readnum',
							type: 'column'
				            //type: 'line'
				        },
				        title: {
				          text: 'Reads Called'
				        },
						xAxis: {
						            title: {
						                text: 'Strand'
						            }
						        },
								yAxis: {
								            title: {
								                text: 'Number of Reads Called'
								            }
								        },
										credits: {
										    enabled: false
										  },
				        legend: {
				            layout: 'vertical',
				            align: 'right',
				            verticalAlign: 'middle',
				            borderWidth: 0
				        },
				        series: []
				    };
	
				    $.getJSON('jsonencode/readnumber.php?prev=0&callback=?', function(data) {
						//alert("success");
				        options.series = data; // <- just assign the data to the series property.
	        
		 
		
				        //options.series = JSON2;
						var chart = new Highcharts.Chart(options);
						});
				});

					//]]>  

					</script>
					<script>
		
					$(document).ready(function() {
					    var options = {
					        chart: {
					            renderTo: 'avglen',
								type: 'column'
					            //type: 'line'
					        },
					        title: {
					          text: 'Average Read Length'
					        },
							xAxis: {
							            title: {
							                text: 'Strand'
							            }
							        },
									yAxis: {
									            title: {
									                text: 'Average Read Length'
									            }
									        },
											credits: {
											    enabled: false
											  },
					        legend: {
					            layout: 'vertical',
					            align: 'right',
					            verticalAlign: 'middle',
					            borderWidth: 0
					        },
					        series: []
					    };
	
					    $.getJSON('jsonencode/avelen.php?prev=0&callback=?', function(data) {
							//alert("success");
					        options.series = data; // <- just assign the data to the series property.
	        
		 
		
					        //options.series = JSON2;
							var chart = new Highcharts.Chart(options);
							});
					});

						//]]>  

						</script>
					<script>
		
					$(document).ready(function() {
					    var options = {
					        chart: {
					            renderTo: 'maxlen',
								type: 'column'
					            //type: 'line'
					        },
					        title: {
					          text: 'Maximum Read Length'
					        },
							xAxis: {
							            title: {
							                text: 'Strand'
							            }
							        },
									yAxis: {
									            title: {
									                text: 'Maximum Read Length'
									            }
									        },
											credits: {
											    enabled: false
											  },
					        legend: {
					            layout: 'vertical',
					            align: 'right',
					            verticalAlign: 'middle',
					            borderWidth: 0
					        },
					        series: []
					    };
	
					    $.getJSON('jsonencode/maxlen.php?prev=0&callback=?', function(data) {
							//alert("success");
					        options.series = data; // <- just assign the data to the series property.
	        
		 
		
					        //options.series = JSON2;
							var chart = new Highcharts.Chart(options);
							});
					});

						//]]>  

						</script>
						<?php include 'includes/coverageincludesjquery.php';?>
							<script>
		
							$(document).ready(function() {
							    var options = {
							        chart: {
							            renderTo: 'percentcoverage',
										type: 'bar'
							            //type: 'line'
							        },
							        title: {
							          text: 'Percentage of Reference with Read'
							        },
									xAxis: {
									            title: {
									                text: 'Strand'
									            }
									        },
											yAxis: {
											            title: {
											                text: 'Percentage'
											            },
														max: 100
											        },
													credits: {
													    enabled: false
													  },
							        legend: {
							            layout: 'vertical',
							            align: 'right',
							            verticalAlign: 'middle',
							            borderWidth: 0
							        },
							        series: []
							    };
	
							    $.getJSON('jsonencode/percentcoverage.php?prev=0&callback=?', function(data) {
									//alert("success");
							        options.series = data; // <- just assign the data to the series property.
	        
		 
		
							        //options.series = JSON2;
									var chart = new Highcharts.Chart(options);
									});
							});

								//]]>  

								</script>
								<script>
		
								$(document).ready(function() {
								    var options = {
								        chart: {
								            renderTo: 'depthcoverage',
											type: 'bar'
								            //type: 'line'
								        },
								        title: {
								          text: 'Average Depth of Sequenced Positions'
								        },
										xAxis: {
										            title: {
										                text: 'Strand'
										            }
										        },
												yAxis: {
												            title: {
												                text: 'Depth'
												            },
												        },
														credits: {
														    enabled: false
														  },
								        legend: {
								            layout: 'vertical',
								            align: 'right',
								            verticalAlign: 'middle',
								            borderWidth: 0
								        },
								        series: []
								    };
	
								    $.getJSON('jsonencode/depthcoverage.php?prev=0&callback=?', function(data) {
										//alert("success");
								        options.series = data; // <- just assign the data to the series property.
	        
		 
		
								        //options.series = JSON2;
										var chart = new Highcharts.Chart(options);
										});
								});

									//]]>  

									</script>
										<script>
							$(document).ready(function() {
							    var options = {
							        chart: {
							            renderTo: 'numberoverlength',
										zoomType: 'x'
							            //type: 'line'
							        },
							        title: {
							          text: 'Read Number Over Length'
							        },
									xAxis: {
									            title: {
									                text: 'Basepairs'
									            }
									        },
											yAxis: {
											            title: {
											                text: 'Number of Reads of this Length'
											            }
											        },
													credits: {
													    enabled: false
													  },
							        legend: {
							            layout: 'vertical',
							            align: 'right',
							            verticalAlign: 'middle',
							            borderWidth: 0
							        },
							        series: []
							    };
								
								    $.getJSON('jsonencode/readnumberlength.php?prev=0&callback=?', function(data) {
								                //alert("success");
                
								        options.series = data; // <- just assign the data to the series property.
        
								
								        //options.series = JSON2;
								                var chart = new Highcharts.Chart(options);
								        });
							});
						    

								//]]>  

								</script>
    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="js/demo/dashboard-demo.js"></script>

     <script>
        $( "#infodiv" ).load( "alertcheck.php" ).fadeIn("slow");
        var auto_refresh = setInterval(function ()
            {
            $( "#infodiv" ).load( "alertcheck.php" ).fadeIn("slow");
            //eval(document.getElementById("infodiv").innerHTML);
            }, 10000); // refresh every 5000 milliseconds
    </script>

<?php include "includes/reporting.php";?>
</body>

</html>
