<!DOCTYPE html>
<html>
<head>
  <title>Euler Diagram</title>
<meta name="description" content="A diagram showing nodes connected by different kinds of links with concentric circular backgrounds.  Clicking on a node opens a window to a Wikipedia page." />
  <!-- Copyright 1998-2016 by Northwoods Software Corporation. -->
  <meta charset="UTF-8">
  <script src="go.js"></script>
  <link href="../assets/css/goSamples.css" rel="stylesheet" type="text/css" />  <!-- you don't need to use this -->
  <script src="goSamples.js"></script>  <!-- this is only for the GoJS Samples framework -->
  <script id="code">
  function init() {
    if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
    var $ = go.GraphObject.make;

    myDiagram =
      $(go.Diagram, "myDiagramDiv",
        { isReadOnly: false, allowSelect: true, contentAlignment: go.Spot.Center });

    myDiagram.nodeTemplate =
      $(go.Node, "Auto",
        { locationSpot: go.Spot.Center },
        new go.Binding("location", "loc", go.Point.parse),
        $(go.Shape, "Ellipse",
          { fill: "transparent" },
          new go.Binding("stroke", "color"),
          new go.Binding("strokeWidth", "width"),
          new go.Binding("strokeDashArray", "dash")),
        $(go.TextBlock,
          { margin: 1, maxSize: new go.Size(80, 80) },
          new go.Binding("text", "text")),
        {
          cursor: "pointer",
          click: function(e, obj) { window.open("https://en.wikipedia.org/w/index.php?search=" + encodeURIComponent(obj.part.data.text)); }
        }
      );

    myDiagram.nodeTemplateMap.add("center",
      $(go.Node, "Spot",
        { locationSpot: go.Spot.Center },
        new go.Binding("location", "loc", go.Point.parse),
        $(go.Panel, "Spot",
          $(go.Shape, "RoundedRectangle",
            { isPanelMain: true, fill: "transparent" },
            new go.Binding("stroke", "color"),
            new go.Binding("strokeWidth", "width"),
            new go.Binding("strokeDashArray", "dash")),
          $(go.TextBlock,
        { text: "this one allows embedded newlines",
          background: "white",
          editable: true })
    
        )
      ));

    myDiagram.linkTemplate =
      $(go.Link,
        $(go.Shape,
          new go.Binding("stroke", "color"),
          new go.Binding("strokeWidth", "width"),
          new go.Binding("strokeDashArray", "dash"))
      );
      
      <?php 
      $i=0;
      $angle = 360/8.0;
      ?>

    var nodeDataArray = [
      { key: 1, text: "Cognitive Procedural", loc: "300 300", category: "center" },
      { key: 11, text: "Logical Reasoning", loc: "<?php 
      $x=300+ 400*cos(deg2rad($i*$angle));
      $y=300+ 270*sin(deg2rad($i*$angle));
      echo $x.' '.$y;
      $i=$i+1;
      ?>" },
      { key: 12, text: "Scaffolding", loc: "<?php 
      $x=300+ 400*cos(deg2rad($i*$angle));
      $y=300+ 270*sin(deg2rad($i*$angle));
      echo $x.' '.$y;
      $i=$i+1;
      ?>" },
      { key: 13, text: "Part Task Training", loc: "<?php 
      $x=300+ 400*cos(deg2rad($i*$angle));
      $y=300+ 270*sin(deg2rad($i*$angle));
      echo $x.' '.$y;
      $i=$i+1;
      ?>" },
      { key: 21, text: "Training Wheels", loc: "<?php 
      $x=300+ 400*cos(deg2rad($i*$angle));
      $y=300+ 270*sin(deg2rad($i*$angle));
      echo $x.' '.$y;
      $i=$i+1;
      ?>" },
      { key: 22, text: "Exploratory Learning", loc: "<?php 
      $x=300+ 400*cos(deg2rad($i*$angle));
      $y=300+ 270*sin(deg2rad($i*$angle));
      echo $x.' '.$y;
      $i=$i+1;
      ?>" },
      { key: 23, text: "Learner Control", loc: "<?php 
      $x=300+ 400*cos(deg2rad($i*$angle));
      $y=300+ 270*sin(deg2rad($i*$angle));
      echo $x.' '.$y;
      $i=$i+1;
      ?>" },
      { key: 31, text: "Overlearning", loc: "<?php 
      $x=300+ 400*cos(deg2rad(60));
      $y=300+ 270*sin(deg2rad(60));
      echo $x.' '.$y;
      $i=$i+1;
      ?>" }
    ];
    var linkDataArray = [
      { from: 1, to: 11, color: "gray",width: 2 },
      { from: 1, to: 12, color: "gray", width: 2 },
      { from: 1, to: 13, color: "gray", width: 2 },
      { from: 1, to: 21, color: "gray", width: 3 },
      { from: 1, to: 22, color: "gray", width: 2 },
      { from: 1, to: 23, color: "gray", width: 2 },
      { from: 1, to: 31 },
      { from: 2, to: 11, color: "gray" },
      { from: 2, to: 12, color: "gray", width: 2 },
      { from: 2, to: 13, color: "gray", width: 2 },
      { from: 2, to: 21, color: "gray", width: 2 },
      { from: 2, to: 22, color: "gray", width: 2 },
      { from: 2, to: 23, color: "gray", width: 3 },
      { from: 2, to: 31, color: "gray", width: 2 }
    ];
    myDiagram.model = new go.GraphLinksModel(nodeDataArray, linkDataArray);
  }
</script>
</head>
<body onload="init()">
<div id="sample">
  <h3>Euler-style Diagram</h3>
  <div id="myDiagramDiv" style="border: solid 1px blue; width:100%; height:600px"></div>
  <p>
    This diagram is read-only, but clicking on a node will search Wikipedia
    with a query string generated from the "text" property of the node data.
  </p>
</div>
</body>
</html>
