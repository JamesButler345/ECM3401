<?php

add_shortcode('mytitle_sc', 'mytitle');

function mytitle() {
// ShortCode: contains title banner and links
?>	
	<div id="title-container">
		<script src="https://kit.fontawesome.com/57715af7c8.js" crossorigin="anonymous"></script>
		<h2 id="mytitle">Forma Mentis Network Visualiser</h2>
		<p id="mytitle" style="padding: 0; margin: 0;">Coded by Jamie Butler<br>Supervised by Massimo Stella</p>
		<div id="linkedIn-link"><a href="https://www.linkedin.com/in/jamieabutler/" target="_blank" class="icon-link"><i class="fab fa-linkedin-in"></i></a></div>
		<p></p>
	</div>
<?php
}

add_shortcode('chart_sc', 'chart');

function chart() {
// ShortCode: contains HEB visualisation and Valence Bar Chart
?>
	<div id="chart-elements">
		<div id="instruction-container">
			<h3 style="margin: 1rem">Introduction</h3>

			<div style="font-family: Source Serif Pro, serif; font-weight: 375;">Welcome to the Forma Mentis Network Visualiser.<br>
				Visualise and Analyse your word association networks.<br>
				Follow these steps to get started:<p>
			</div>
			<div id="instructions" style="font-family: Source Serif Pro, serif; font-weight: 375;">
				<ol>
					<li>Format your network in accordance with our <a href="../../../../py/downloads/TemplateUploadFile.xlsx">template</a>.					
					<li>Upload your association .xlsx files below.
					<li>Chose a root word, the visualisation will be built from this word's neighbourhood.
					<li>Click Visualise and Voila.
				</ol>
			</div>
			<div style="font-family: Source Serif Pro, serif; font-weight: 375; padding-bottom: 10px;">You will then be able to interact with your network through<br>
				 an edge bundling chart and dive into the valence scores<br>
				 of your network.
			</div>

			
		</div>
		<div id="chart-container">

			<div style="text-align: center;"><h3 style="margin: 1rem">Edge Bundling Chart</h3></div>
			<div id="chart-root-node" value="" style="text-align: center; font-family: Source Serif Pro, serif; font-weight: 375;"></div>

			<div id="chart" class="chart">
				<div>Upload your files to show visualisation</div>
			</div>
		</div>
		<div id="graph-container">
			<div id="graph-text-container">
				<h3 style="margin: 1rem">Valence Chart</h3>

				<label for="user2">Select a word to visualise:</label>
   				
				<div id="graph-input-box">
					<input list="graph_list" id="user2" name="user2">
			
   					<datalist id="graph_list">
   					</datalist>
					<button id="update_graph_btn">Update</button>
				</div>
    				
			</div>
			<div id="graph-bar-chart">
				<canvas id="myChart"></canvas>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

		<script>
			const labels = [
   				'1',
   				'2',
  				'3',
  				'4',
   				'5'				
  			];
		
 			const data = {
  		 		labels: labels,
  				datasets: [{
   			  	 	label: 'Valence Scores',
   					backgroundColor: ['rgb(206, 58, 110)', 'rgb(206, 96, 157)', 'rgb(56, 56, 56)', 'rgb(74, 98, 163)', 'blue'],
  	 			   	data: [0, 0, 0, 0, 0],
 	 			}]
 			};
	
 			const config = {
  	  			type: 'bar',	
	    			data: data,
	    			options: {
					scales: {
    						x: {
    	        					display: true,
							title: {
								display: true,
								text: 'User Scores'
							}
   	         				},
      	      					y: {
     	          					display: true
      	      					}
     	   				}	
				}
  			};
	
			const myChart = new Chart(
	    			document.getElementById('myChart'),
    				config
  			);

		</script>
			
	</div>
	<p></p>
	<div id="downloads-container">
		<span id="downloads"><a href = "../../../../py/downloads/lemmatized_node_pairs.xlsx" style="text-decoration: none;" download = "lemmatized_node_pairs">Download Edge List</a></span>
		<span id="downloads"><a href = "../../../../py/downloads/node_valence_analysis.xlsx" style="text-decoration: none;" download = "node_valence_analysis">Download Valence Analysis</a></span>
		<span id="downloads"><a href = "../../../../py/downloads/network_closeness_scores.xlsx" style="text-decoration: none;" download = "network_closeness_scores">Download Closeness Scores</a></span>
	</div>
<?php
}

add_shortcode('datalist_sc', 'datalist');

function datalist() {
// ShortCode: contains root node dropdown selecter
?>
	<div id="datalist_container">
		<p></p>
		<br>
		<div id="datalist_input">
   			<label for="user">Please now select a root node: </label>
   			<input list="chart_list" id="user" name="user">
		
   			<datalist id="chart_list">
   			</datalist>
    			<button id="load_chart_btn">Visualise</button>
		</div>
		<div style="display: none;"><input type="checkbox" id="ita_data2"></input></div>
		<div id="loader"></div>	
	</div>
	<div id="background-pattern"></div>

<?php
}

add_shortcode('cleardb_sc', 'clear_db');

function clear_db() {
// ShortCode: contains the clear database card
?>
	<div id="cleardb_container">
		<div id="cleardb_box">
			<label>Ensure database is empty before use!</label>
    			<button id="delete_uploads_btn">Clear Database</button>
		</div>
	</div>
<?php
}
?>


