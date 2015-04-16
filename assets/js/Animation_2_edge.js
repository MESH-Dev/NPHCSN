/*jslint */
/*global AdobeEdge: false, window: false, document: false, console:false, alert: false */
(function (compId) {

    "use strict";
    var im='images/',
        aud='media/',
        vid='media/',
        js='js/',
        fonts = {
        },
        opts = {
            'gAudioPreloadPreference': 'auto',
            'gVideoPreloadPreference': 'auto'
        },
        resources = [
        ],
        scripts = [
        ],
        symbols = {
            "stage": {
                version: "5.0.1",
                minimumCompatibleVersion: "5.0.0",
                build: "5.0.1.386",
                scaleToFit: "none",
                centerStage: "none",
                resizeInstances: false,
                content: {
                    dom: [
                        {
                            id: 'Site_Illustrations_03_25_15_symbol_12',
                            symbolName: 'Site_Illustrations_03_25_15_symbol_1',
                            type: 'rect',
                            rect: ['83px', '-33px', '384px', '466px', 'auto', 'auto']
                        }
                    ],
                    style: {
                        '${Stage}': {
                            isStage: true,
                            rect: [undefined, undefined, '550px', '400px'],
                            overflow: 'hidden',
                            fill: ["rgba(255,255,255,1)"]
                        }
                    }
                },
                timeline: {
                    duration: 583.33333333333,
                    autoPlay: true,
                    data: [
                        [
                            "eid19",
                            "top",
                            0,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15_symbol_12}",
                            '-33px',
                            '-33px'
                        ],
                        [
                            "eid18",
                            "left",
                            0,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15_symbol_12}",
                            '83px',
                            '83px'
                        ]
                    ]
                }
            },
            "Site_Illustrations_03_25_15_symbol_1": {
                version: "5.0.1",
                minimumCompatibleVersion: "5.0.0",
                build: "5.0.1.386",
                scaleToFit: "none",
                centerStage: "none",
                resizeInstances: false,
                content: {
                    dom: [
                        {
                            id: 'Site_Illustrations_03_25_15',
                            type: 'image',
                            rect: ['0px', '0px', '1922px', '1398px', 'auto', 'auto'],
                            fill: ['rgba(0,0,0,0)', 'images/Site_Illustrations_03_25_15.png', '0px', '0px', '1922px', '1398px']
                        }
                    ],
                    style: {
                        '${symbolSelector}': {
                            rect: [null, null, '384px', '466px']
                        }
                    }
                },
                timeline: {
                    duration: 583.33333333333,
                    autoPlay: true,
                    data: [
                        [
                            "eid1",
                            "height",
                            0,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            '0px',
                            '466px'
                        ],
                        [
                            "eid2",
                            "width",
                            0,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            '0px',
                            '384px'
                        ],
                        [
                            "eid3",
                            "background-position",
                            0,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [0,0],
                            [-0,-0],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ],
                        [
                            "eid4",
                            "background-position",
                            41,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [-0,-0],
                            [-384,-0],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ],
                        [
                            "eid5",
                            "background-position",
                            83,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [-384,-0],
                            [-768,-0],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ],
                        [
                            "eid6",
                            "background-position",
                            125,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [-768,-0],
                            [-1152,-0],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ],
                        [
                            "eid7",
                            "background-position",
                            166,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [-1152,-0],
                            [-1536,-0],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ],
                        [
                            "eid8",
                            "background-position",
                            208,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [-1536,-0],
                            [-0,-466],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ],
                        [
                            "eid9",
                            "background-position",
                            250,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [-0,-466],
                            [-384,-466],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ],
                        [
                            "eid10",
                            "background-position",
                            291,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [-384,-466],
                            [-768,-466],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ],
                        [
                            "eid11",
                            "background-position",
                            333,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [-768,-466],
                            [-1152,-466],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ],
                        [
                            "eid12",
                            "background-position",
                            375,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [-1152,-466],
                            [-1536,-466],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ],
                        [
                            "eid13",
                            "background-position",
                            416,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [-1536,-466],
                            [-0,-932],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ],
                        [
                            "eid14",
                            "background-position",
                            458,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [-0,-932],
                            [-384,-932],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ],
                        [
                            "eid15",
                            "background-position",
                            500,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [-384,-932],
                            [-768,-932],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ],
                        [
                            "eid16",
                            "background-position",
                            541,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [-768,-932],
                            [-1152,-932],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ],
                        [
                            "eid17",
                            "background-position",
                            583,
                            0,
                            "linear",
                            "${Site_Illustrations_03_25_15}",
                            [-1152,-932],
                            [-1536,-932],
                            {valueTemplate: '@@0@@px @@1@@px'}
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("Animation_2_edgeActions.js");
})("EDGE-26294147");
