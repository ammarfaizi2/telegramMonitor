var  DIR = 'assets/img/node/'; 
nodes = new vis.DataSet([
    {id: 1,  shape: 'circularImage', image: DIR + '1.jpg', label:'Miranda', font: {color: "white"}},
        {id: 2,  shape: 'circularImage', image: DIR + '2.jpg' , label: 'Arjuna',font: {color: "white"}},
        {id: 3,  shape: 'circularImage', image: DIR + '3.jpg', label: 'Riko Siahaan', font: {color: "white"}},
        {id: 4,  shape: 'circularImage', image: DIR + '4.jpg', label:"Orang yang terhubung dengan Marsela", font: {color: "black", background:"white"}},
        {id: 5,  shape: 'circularImage', image: DIR + '5.jpg', label:'M. Kurniawan', font: {color: "white"}},
        {id: 6,  shape: 'circularImage', image: DIR + '6.jpg', label:'Joni Vino', font: {color: "white"}},
        {id: 7,  shape: 'circularImage', image: DIR + '7.jpg', label:'Enrique', font: {color: "white"}},
        {id: 8,  shape: 'circularImage', image: DIR + '8.jpg', label:'Lafran', font: {color: "white"}},
        {id: 9,  shape: 'circularImage', image: DIR + '9.jpg', label:'Marko', font: {color: "white"}}
]);

// create an array with edges
var edges = new vis.DataSet([
    {from: 1, to: 3},
    {from: 1, to: 2},
    {from: 2, to: 4, length: 100, label:'Ibu', font:{align:'middle'}},
    {from: 2, to: 5},
    {from: 9, to: 1},
    {from: 5, to: 8},
    {from: 6, to: 3},
    {from: 7, to: 4, length: 100, label:'Ayah', font:{align:'middle'}},
    {from: 4, to: 1},
    {from: 6, to: 5}
]);

// create a network
var container = document.getElementById('OntologyDemo');

// provide the data in the vis format
var data = {
    nodes: nodes,
    edges: edges
};
var options = {
    nodes: {borderWidth: 1,
        borderWidthSelected: 2,
        brokenImage:undefined,
        chosen: true,
        color: {
          border: '#FEDBDC',
          background: '#FEDBDC',
          highlight: {
            border: '#2B7CE9',
            background: '#D2E5FF'
          },
          hover: {
            border: '#2B7CE9',
            background: '#D2E5FF'
          }
        }
    }
};
var options = {
    interaction:{hover:true},
    manipulation: {
        enabled: true
    }
};

// initialize your network!
var network = new vis.Network(container, data, options);
