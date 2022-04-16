import define from "./HEBgraph.js";
import {Runtime, Library, Inspector} from "./runtime.js";

document.addEventListener( 'wpcf7mailsent', function( event ) {
/*
Event Lister for Contact Form 7 DOM event wpcf7mailsent:
Opens loading spinner
Ajax call runs create_datalist.php
Ajax Done Function:
Creates and populates dropdowns for HEB and bar chart node selection.
*/

  // Open loading spinner
  var spinner = document.getElementById("loader");
  spinner.classList.toggle('fade');

  // Open datalist div
  var datalist = document.getElementById("datalist_input");
  datalist.style.display = "none";  

  var tickbox = false;
  
  // Check state of Italian Flag for NLP
  document.getElementById("ita_data2").checked = false;
  if (document.getElementById("ita_data").checked == true){
  	tickbox = 'true';
	console.log("box ticked");
	document.getElementById("ita_data2").checked = true;
  }


  jQuery.ajax({
	type: 'post',
	url: chart_vars.ajax_url,
	data: {
		action: 'create_datalist',
		tag: tickbox,
	},
  })
  .done(function() {
	
	jQuery.get("../../../../../py/word_list.txt",
		function(data,error) {
			if (error) {
				console.log(error);
			}

			var currentStr = ""

			// Create and populate dropdown fields.
          		for ( var i in data) {
            			if (data[i] == "\n") {
					var newOptionElementChart = document.createElement("option");
					var newOptionElementGraph = document.createElement("option");

                      			newOptionElementChart.textContent = currentStr.trim();
                      			newOptionElementGraph.textContent = currentStr.trim();


                     			var listNameElementChart = document.getElementById("chart_list"); 
                     			var listNameElementGraph = document.getElementById("graph_list"); 

                     			listNameElementChart.appendChild(newOptionElementChart);
                     			listNameElementGraph.appendChild(newOptionElementGraph);
                      
               			  	currentStr = "";
                			continue;    
	    			}
            			currentStr += data[i];
         		}					
	});
	// Display datalist div
  	datalist.style.display = "block";  
	// Close loading spinner
  	spinner.classList.toggle('fade');

  });
}, false );


jQuery("#load_chart_btn").click(function(){
/*
Event runs when 'visualise' button is clicked.
Changes page from the landing page layout to show visualisation layout.
Ajax call runs load_chart.php that prepares HEB model, Valence Bar Chart, and Analytical Tools.
Ajax Done Function:
Loads valence data into localstorage and presents visualisation layout.
*/

	var input = document.getElementById("user").value;
	console.log(input);
	if (input == '*') {
		alert("Input cannot be *");
		return;
	}

	// Open Loading Spinner
	var spinner = document.getElementById("loader");
	spinner.classList.toggle('fade');

	// Load HTML elements to change the display properties of later
	var downloads = document.getElementById("downloads-container");
	var chartCard = document.getElementById("chart-container");
	var graphCard = document.getElementById("graph-container");
	var instructionCard = document.getElementById("instruction-container");
	var chartRootNode = document.getElementById("chart-root-node");
	var rootTitle = "Root Node: " + input;

	// Check state of Italian flag
	var tickbox = false;
	if (document.getElementById("ita_data2").checked == true){
		tickbox = 'true';
		console.log("box ticked");
  	}


 	jQuery.ajax({
		type: 'post',
		url: chart_vars.ajax_url,
		data: {
			action: 'load_chart',
			root: input,
			tag: tickbox,
		},
 	})
 	.done(function(data) {

		// Prepare HEB model
		const runtime = new Runtime();
		const main = runtime.module(define, name => {
			if (name == 'chart') {
				return new Inspector(document.getElementById('chart'))
			}
		});


		// Load valence data into Local storage
	
		window.localStorage.clear();	

		const graph_data = JSON.parse(data);

		var arr_len = Object.keys(graph_data).length;

		for (var key in graph_data) {

			const arr_scores = [0, 0, 0, 0, 0];

			for (var score in graph_data[key]) {

				arr_scores[graph_data[key][score] - 1] += 1;						
			
			}			

			window.localStorage.setItem(key, JSON.stringify(arr_scores));
		
		}

		console.log("done");
		
		// Change display properties to display visualisation page layout.
		instructionCard.style.display = "none";
		chartRootNode.innerHTML = rootTitle; 
		spinner.classList.toggle('fade');
		chartCard.style.display = "block";
		graphCard.style.display = "block";
		downloads.style.display = "flex";
		
	});	
	

});

jQuery("#update_graph_btn").click(function(){
/*
Enables the valence bar chart to asynchronously update with data from local storage
*/
	// Retrieve chart instance
	const chart = Chart.getChart("myChart");

	// Get the node the user has selected
	var input = document.getElementById("user2").value;

	// Retrieve node's scores from local storage
	var get_item = JSON.parse(window.localStorage.getItem(input));
	
	const new_arr = new Array(get_item);
	console.log(new_arr[0]);
	
	// Update graph to display new scores
	chart.data.datasets.pop();
	chart.data.datasets.push({
		label: input + ' scores',
   		backgroundColor: ['rgb(206, 58, 110)', 'rgb(163, 94, 118)', 'rgb(56, 56, 56)', 'rgb(74, 98, 163)', 'blue'],
		data: new_arr[0]
	});

	chart.update();
});

jQuery("#delete_uploads_btn").click(function(){
/*
Uses Ajax call to clear the database of user uploaded files to prevent cross contamination from multiple users
*/
	jQuery.ajax({
		type: 'post',
		url: chart_vars.ajax_url,
		data: {
			action: 'delete_uploads',
		},
 	})
 	.done( function() {
		alert("Database cleared!");
	});

});

