var DatatableDataLocalDemo= {
    init:function() {
        var e,
        a,
        i;
        e=JSON.parse('[{"ID":39,"NamaOrang":"Helaine Haveline","AlamatOrang":"4 Gina Road","JenisKelamin":2,"TotalKejahatan":4},{"ID":33,"NamaOrang":"Mariquilla Palmby","AlamatOrang":"9 6th Court","JenisKelamin":1,"TotalKejahatan":11},{"ID":31,"NamaOrang":"Kat Newvell","AlamatOrang":"69603 Eastlawn Circle","JenisKelamin":2,"TotalKejahatan":10},{"ID":20,"NamaOrang":"Christian Luton","AlamatOrang":"52 Rusk Lane","JenisKelamin":1,"TotalKejahatan":10},{"ID":13,"NamaOrang":"Drusy Josse","AlamatOrang":"4 New Castle Way","JenisKelamin":1,"TotalKejahatan":17},{"ID":27,"NamaOrang":"Kippie Kingcott","AlamatOrang":"3124 Debra Avenue","JenisKelamin":2,"TotalKejahatan":4},{"ID":6,"NamaOrang":"Lemmie Rainbird","AlamatOrang":"3 Mandrake Plaza","JenisKelamin":2,"TotalKejahatan":12},{"ID":22,"NamaOrang":"Harriett Hallt","AlamatOrang":"73 Merchant Circle","JenisKelamin":2,"TotalKejahatan":9},{"ID":25,"NamaOrang":"Marys Dungate","AlamatOrang":"4 Ridgeview Road","JenisKelamin":1,"TotalKejahatan":7},{"ID":22,"NamaOrang":"Rutledge MacGhee","AlamatOrang":"39522 Armistice Court","JenisKelamin":1,"TotalKejahatan":14},{"ID":31,"NamaOrang":"Karisa Whistlecraft","AlamatOrang":"28807 Brentwood Crossing","JenisKelamin":2,"TotalKejahatan":20},{"ID":49,"NamaOrang":"Ddene Dumbare","AlamatOrang":"54548 Miller Circle","JenisKelamin":1,"TotalKejahatan":2},{"ID":2,"NamaOrang":"Sidonnie Kures","AlamatOrang":"40 Eagan Parkway","JenisKelamin":1,"TotalKejahatan":1},{"ID":18,"NamaOrang":"Becka Daffern","AlamatOrang":"2411 Basil Circle","JenisKelamin":2,"TotalKejahatan":17},{"ID":7,"NamaOrang":"Terencio Angove","AlamatOrang":"73043 Linden Junction","JenisKelamin":1,"TotalKejahatan":14},{"ID":5,"NamaOrang":"Padgett Belsher","AlamatOrang":"450 Springview Point","JenisKelamin":2,"TotalKejahatan":1},{"ID":14,"NamaOrang":"Shandy Gauch","AlamatOrang":"82 Thompson Way","JenisKelamin":2,"TotalKejahatan":8},{"ID":31,"NamaOrang":"Marget Woollons","AlamatOrang":"12788 Stone Corner Pass","JenisKelamin":1,"TotalKejahatan":8},{"ID":5,"NamaOrang":"Marya Sandilands","AlamatOrang":"0153 Dorton Junction","JenisKelamin":1,"TotalKejahatan":4},{"ID":8,"NamaOrang":"Kimball Furst","AlamatOrang":"6060 Mariners Cove Junction","JenisKelamin":1,"TotalKejahatan":8},{"ID":25,"NamaOrang":"Delmor Holme","AlamatOrang":"72960 Fremont Point","JenisKelamin":2,"TotalKejahatan":6},{"ID":27,"NamaOrang":"Yolane Stampe","AlamatOrang":"1 Old Gate Plaza","JenisKelamin":2,"TotalKejahatan":12},{"ID":41,"NamaOrang":"Modesty Gerren","AlamatOrang":"9654 Monica Drive","JenisKelamin":1,"TotalKejahatan":13},{"ID":23,"NamaOrang":"Merrilee Ferrai","AlamatOrang":"7 Ruskin Circle","JenisKelamin":2,"TotalKejahatan":10},{"ID":12,"NamaOrang":"Cristabel Tonkes","AlamatOrang":"0348 Morningstar Place","JenisKelamin":2,"TotalKejahatan":2},{"ID":33,"NamaOrang":"Colleen Borgne","AlamatOrang":"8 Mesta Circle","JenisKelamin":2,"TotalKejahatan":10},{"ID":24,"NamaOrang":"Bobbette Pierton","AlamatOrang":"517 Lien Road","JenisKelamin":2,"TotalKejahatan":15},{"ID":1,"NamaOrang":"Augustine Heald","AlamatOrang":"9407 Merry Drive","JenisKelamin":1,"TotalKejahatan":13},{"ID":46,"NamaOrang":"Cecily Fink","AlamatOrang":"58167 Red Cloud Park","JenisKelamin":2,"TotalKejahatan":13},{"ID":28,"NamaOrang":"Elfrieda Belleny","AlamatOrang":"051 Blackbird Way","JenisKelamin":2,"TotalKejahatan":15},{"ID":10,"NamaOrang":"Dorri Wilson","AlamatOrang":"20417 Meadow Vale Avenue","JenisKelamin":1,"TotalKejahatan":13},{"ID":32,"NamaOrang":"Leeanne Finden","AlamatOrang":"909 Independence Hill","JenisKelamin":2,"TotalKejahatan":8},{"ID":11,"NamaOrang":"Cesaro O Bradane","AlamatOrang":"2054 Kennedy Circle","JenisKelamin":1,"TotalKejahatan":9},{"ID":15,"NamaOrang":"Bryant Wollacott","AlamatOrang":"94175 Memorial Hill","JenisKelamin":2,"TotalKejahatan":15},{"ID":17,"NamaOrang":"Salomi Dearman","AlamatOrang":"89130 Lerdahl Hill","JenisKelamin":2,"TotalKejahatan":1},{"ID":3,"NamaOrang":"Elayne Paeckmeyer","AlamatOrang":"9094 Merrick Terrace","JenisKelamin":1,"TotalKejahatan":14},{"ID":49,"NamaOrang":"Carleton Laraway","AlamatOrang":"322 Holy Cross Crossing","JenisKelamin":1,"TotalKejahatan":1},{"ID":25,"NamaOrang":"Jamaal Rich","AlamatOrang":"59282 School Junction","JenisKelamin":2,"TotalKejahatan":5},{"ID":5,"NamaOrang":"Brynna Broadnicke","AlamatOrang":"7564 Harbort Drive","JenisKelamin":1,"TotalKejahatan":10},{"ID":6,"NamaOrang":"Jeniffer Emtage","AlamatOrang":"93726 Washington Place","JenisKelamin":2,"TotalKejahatan":10},{"ID":39,"NamaOrang":"Timmy Larrad","AlamatOrang":"9314 Glacier Hill Alley","JenisKelamin":2,"TotalKejahatan":7},{"ID":17,"NamaOrang":"Myer Spino","AlamatOrang":"29 Lerdahl Court","JenisKelamin":1,"TotalKejahatan":2},{"ID":2,"NamaOrang":"Cleve Broxap","AlamatOrang":"23 Dorton Terrace","JenisKelamin":2,"TotalKejahatan":12},{"ID":17,"NamaOrang":"Theresa Penna","AlamatOrang":"328 Charing Cross Drive","JenisKelamin":1,"TotalKejahatan":18},{"ID":36,"NamaOrang":"Barrett Roggerone","AlamatOrang":"9 Bunting Lane","JenisKelamin":1,"TotalKejahatan":13},{"ID":31,"NamaOrang":"Royall Ogan","AlamatOrang":"47 Fremont Circle","JenisKelamin":1,"TotalKejahatan":13},{"ID":8,"NamaOrang":"Roarke Maudlin","AlamatOrang":"6 Bunker Hill Way","JenisKelamin":1,"TotalKejahatan":11},{"ID":9,"NamaOrang":"Jacquie Philcox","AlamatOrang":"328 Novick Center","JenisKelamin":1,"TotalKejahatan":11},{"ID":13,"NamaOrang":"Loni Keynes","AlamatOrang":"5244 Melvin Point","JenisKelamin":1,"TotalKejahatan":14},{"ID":31,"NamaOrang":"Dukie Hun","AlamatOrang":"2 Valley Edge Point","JenisKelamin":2,"TotalKejahatan":5}]'),
        a=$(".m_datatable").mDatatable( {
            data: {
                type: "local", source: e, pageSize: 10
            }
            , layout: {
                theme: "default", class: "", scroll: !1, footer: !1
            }
            , sortable:!0, pagination:!0, search: {
                input: $("#generalSearch")
            }
            , columns:[ {
                field:"RecordID", title:"#", width:50, sortable:!1, textAlign:"center", selector: {
                    class: "m-checkbox--solid m-checkbox--brand"
                }
            }
            , {
                field: "ID", title: "ID", width: 20
            }
            , {
                field:"NamaOrang", title:"Nama", responsive: {
                    visible: "lg"
                }
            }
            , {
                field: "AlamatOrang", title: "Alamat Orang", width: 100
            }
            , {
                field:"JenisKelamin", title:"Jenis Kelamin", template:function(e) {
                    var a= {
                        1: {
                            title: "Laki-laki"
                        }
                        , 2: {
                            title: "Perempuan"
                        }
                    }
                }
            }
            , {
                field: "TotalKejahatan", title: "Total Kejahatan", type: "number"
            }
            , {
                field:"Actions", width:110, title:"Actions", sortable:!1, overflow:"visible", template:function(e, a, i) {
                    return'<a href="detail-orang.html" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="View ">                            <i class="flaticon-more"></i>                        </a>\t\t\t\t\t'
                }
            }
            ]
        }
        ),
        i=a.getDataSourceQuery(),
        $("#m_form_status").on("change", function() {
            a.search($(this).val(), "Status")
        }
        ).val(void 0!==i.Type?i.Type:""),
        $("#jenis_kelamin").on("change", function() {
            a.search($(this).val(), "JenisKelamin")
        }
        ).val(void 0!==i.Type?i.Type:""),
        $("#m_form_status, #jenis_kelamin").selectpicker()
    }
}

;
jQuery(document).ready(function() {
    DatatableDataLocalDemo.init()
}

);