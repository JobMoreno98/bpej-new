<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link
    href="https://cdn.datatables.net/v/bs5/dt-2.1.8/af-2.7.0/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/datatables.min.css"
    rel="stylesheet">

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.material.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/14.0.0/material-components-web.min.css">



<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/5.0.3/css/fixedColumns.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/2.1.0/css/select.dataTables.css">
<style>
    td {
        padding: 10px;
    }

    .content-wrapper {
        background: #fff;
        border-radius: 40px 0px 0px;
        ;
    }

    .color-bpej {
        background: #7c2422;
    }

    .brand-link {
        border-bottom: none !important;
        text-decoration: none !important;
    }

    .wrapper {
        background: #7c2422 !important;
    }

    .border-redondo {
        border-radius: 0px 10px 10px 0px;
    }

    .menu-header.active {
        background-color: #034c9b !important;
    }

    .submenu-active .active {
        color: #000 !important;
    }

    .mdc-data-table__cell {
        border-bottom: none !important;
    }

    /*--------------------------------------------------------------
# Preloader
--------------------------------------------------------------*/
    :root {
        --background-color: #ffffff;
        /* Background color for the entire website, including individual sections */
        --default-color: #222222;
        /* Default color used for the majority of the text content across the entire website */
        --heading-color: #172a28;
        /* Color for headings, subheadings and title throughout the website */
        --accent-color: #7c2422;
    }

    #preloader {
        position: fixed;
        inset: 0;
        z-index: 999999;
        overflow: hidden;
        background: var(--background-color);
        transition: all 0.6s ease-out;
    }

    #preloader:before {
        content: "";
        position: fixed;
        top: calc(50% - 30px);
        left: calc(50% - 30px);
        border: 6px solid #ffffff;
        border-color: var(--accent-color) transparent var(--accent-color) transparent;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: animate-preloader 1.5s linear infinite;
    }

    @keyframes animate-preloader {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
