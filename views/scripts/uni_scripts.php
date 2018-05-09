<?php if (isset($datepicker)) { ?>
<script src="<?=base_url()?>resource/js/slider/bootstrap-slider.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/locales/bootstrap-datepicker.<?=(lang('lang_code') == 'en' ? 'en-GB': lang('lang_code'))?>.min.js"></script>

<script type="text/javascript">
$('.datepicker-input').datepicker({
    todayHighlight: true,
    todayBtn: "linked",
    autoclose: true
});
</script>
<?php } ?>

<?php if (isset($form)) { ?>
<script src="<?=base_url()?>resource/js/libs/select2.min.js"></script>
<script src="<?=base_url()?>resource/js/file-input/bootstrap-filestyle.min.js"></script>
<script src="<?=base_url()?>resource/js/wysiwyg/jquery.hotkeys.js"></script>
<script src="<?=base_url()?>resource/js/wysiwyg/bootstrap-wysiwyg.js"></script>
<script src="<?=base_url()?>resource/js/wysiwyg/demo.js"></script>
<script src="<?=base_url()?>resource/js/parsley/parsley.min.js"></script>
<script src="<?=base_url()?>resource/js/parsley/parsley.extend.js"></script>
<?php } ?>
<?php if ($this->uri->segment(2) == 'help') { ?>
 <!-- App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/1.0.0/intro.min.js"> </script>
<script src="<?=base_url()?>resource/js/intro/demo.js"> </script>
<?php }  ?>

<?php
if (isset($datatables)) {
    $sort = strtoupper(config_item('date_picker_format'));
?>
<script src="<?=base_url()?>resource/js/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>resource/js/datatables/dataTables.bootstrap.min.js"></script>

<script src="<?=base_url()?>resource/js/datatables/datetime-moment.js"></script>
<script type="text/javascript">
        jQuery.extend( jQuery.fn.dataTableExt.oSort, {
            "currency-pre": function (a) {
                a = (a==="-") ? 0 : a.replace( /[^\d\-\.]/g, "" );
                return parseFloat( a ); },
            "currency-asc": function (a,b) {
                return a - b; },
            "currency-desc": function (a,b) {
                return b - a; }
        });
        $.fn.dataTableExt.oApi.fnResetAllFilters = function (oSettings, bDraw/*default true*/) {
                for(iCol = 0; iCol < oSettings.aoPreSearchCols.length; iCol++) {
                        oSettings.aoPreSearchCols[ iCol ].sSearch = '';
                }
                oSettings.oPreviousSearch.sSearch = '';

                if(typeof bDraw === 'undefined') bDraw = true;
                if(bDraw) this.fnDraw();
        }

        $(document).ready(function() {

        $.fn.dataTable.moment('<?=$sort?>');
        $.fn.dataTable.moment('<?=$sort?> HH:mm');

        var oTable1 = $('.AppendDataTables').dataTable({
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-4'l><'col-sm-8'f>r>t<'row'<'col-sm-4'i><'col-sm-8'p>>",
        "sPaginationType": "full_numbers",
        "iDisplayLength": <?=config_item('rows_per_table')?>,
        "oLanguage": {
                "sProcessing": "<?=lang('processing')?>",
                "sLoadingRecords": "<?=lang('loading')?>",
                "sLengthMenu": "<?=lang('show_entries')?>",
                "sEmptyTable": "<?=lang('empty_table')?>",
                "sInfo": "<?=lang('pagination_info')?>",
                "sInfoEmpty": "<?=lang('pagination_empty')?>",
                "sInfoFiltered": "<?=lang('pagination_filtered')?>",
                "sInfoPostFix":  "",
                "sSearch": "<?=lang('search')?>:",
                "sUrl": "",
                "oPaginate": {
                        "sFirst":"<?=lang('first')?>",
                        "sPrevious": "<?=lang('previous')?>",
                        "sNext": "<?=lang('next')?>",
                        "sLast": "<?=lang('last')?>"
                }
        },
        "tableTools": {
                    "sSwfPath": "<?=base_url()?>resource/js/datatables/tableTools/swf/copy_csv_xls_pdf.swf",
              "aButtons": [
                      {
                      "sExtends": "csv",
                      "sTitle": "<?=config_item('company_name').' - '.lang('invoices')?>"
                  },
                      {
                      "sExtends": "xls",
                      "sTitle": "<?=config_item('company_name').' - '.lang('invoices')?>"
                  },
                      {
                      "sExtends": "pdf",
                      "sTitle": "<?=config_item('company_name').' - '.lang('invoices')?>"
                  },
              ],
        },
        "aaSorting": [],
        "aoColumnDefs":[{
                    "aTargets": ["no-sort"]
                  , "bSortable": false
              },{
                    "aTargets": ["col-currency"]
                  , "sType": "currency"
              }]
        });
            $("#table-tickets").dataTable().fnSort([[0,'desc']]);
            $("#table-tickets-archive").dataTable().fnSort([[1,'desc']]);
            $("#table-projects").dataTable().fnSort([[0,'desc']]);
            $("#table-projects-client").dataTable().fnSort([[4,'asc']]);
            $("#table-projects-archive").dataTable().fnSort([[5,'desc']]);
            $("#table-teams").dataTable().fnSort([[0,'asc']]);
            $("#table-milestones").dataTable().fnSort([[2,'desc']]);
            $("#table-milestone").dataTable().fnSort([[2,'desc']]);
            $("#table-tasks").dataTable().fnSort([[2,'desc']]);
            $("#table-files").dataTable().fnSort([[2,'desc']]);
            $("#table-links").dataTable().fnSort([[0,'asc']]);
            $("#table-project-timelog").dataTable().fnSort([[0,'desc']]);
            $("#table-tasks-timelog").dataTable().fnSort([[0,'desc']]);
            $("#table-clients").dataTable().fnSort([[0,'asc']]);
            $("#table-client-details-1").dataTable().fnSort([[1,'asc']]);
            $("#table-client-details-2").dataTable().fnSort([[2,'desc']]);
            $("#table-client-details-3").dataTable().fnSort([[0,'asc']]);
            $("#table-client-details-4").dataTable().fnSort([[1,'asc']]);
            $("#table-templates-1").dataTable().fnSort([[0,'asc']]);
            $("#table-templates-2").dataTable().fnSort([[0,'asc']]);
            $("#table-invoices").dataTable().fnSort([[0,'desc']]);
            $("#table-estimates").dataTable().fnSort([[0,'desc']]);
            $("#table-payments").dataTable().fnSort([[0,'desc']]);
            $("#table-users").dataTable().fnSort([[4,'desc']]);
            $("#table-rates").dataTable().fnSort([[0,'asc']]);
            $("#table-bugs").dataTable().fnSort([[1,'desc']]);
            $("#table-stuff").dataTable().fnSort([[0,'asc']]);
            $("#table-activities").dataTable().fnSort([[0,'desc']]);
            $("#table-expenses").dataTable().fnSort([[0,'desc']]);
            $("#table-strings").DataTable().page.len(-1).draw();
            if ($('#table-strings').length == 1) { $('#table-strings_length, #table-strings_paginate').remove(); $('#table-strings_filter input').css('width','200px'); }


        $('#save-translation').on('click', function (e) {
            e.preventDefault();
            oTable1.fnResetAllFilters();
            $.ajax({
                url: base_url+'settings/translations/save/?settings=translations',
                type: 'POST',
                data: { json : JSON.stringify($('#form-strings').serializeArray()) },
                success: function() {
                    toastr.success("<?=lang('translation_updated_successfully')?>", "<?=lang('response_status')?>");
                },
                error: function(xhr) {
                    alert('Error: '+JSON.stringify(xhr));
                }
            });
        });
        $('#table-translations').on('click','.backup-translation', function (e) {
            e.preventDefault();
            var target = $(this).attr('data-href');
            $.ajax({
                url: target,
                type: 'GET',
                data: {},
                success: function() {
                    toastr.success("<?=lang('translation_backed_up_successfully')?>", "<?=lang('response_status')?>");
                },
                error: function(xhr) {
                    alert('Error: '+JSON.stringify(xhr));
                }
            });
        });
        $("#table-translations").on('click', '.restore-translation', function (e) {
            e.preventDefault();
            var target = $(this).attr('data-href');
            $.ajax({
                url: target,
                type: 'GET',
                data: {},
                success: function() {
                    toastr.success("<?=lang('translation_restored_successfully')?>", "<?=lang('response_status')?>");
                },
                error: function(xhr) {
                    alert('Error: '+JSON.stringify(xhr));
                }
            });
        });
        $('#table-translations').on('click','.submit-translation', function (e) {
            e.preventDefault();
            var target = $(this).attr('data-href');
            $.ajax({
                url: target,
                type: 'GET',
                data: {},
                success: function() {
                    toastr.success("<?=lang('translation_submitted_successfully')?>", "<?=lang('response_status')?>");
                },
                error: function(xhr) {
                    alert('Error: '+JSON.stringify(xhr));
                }
            });
        });
        $("#table-translations").on('click','.active-translation',function (e) {
            e.preventDefault();
            var target = $(this).attr('data-href');
            var isActive = 0;
            if (!$(this).hasClass('btn-success')) { isActive = 1; }
            $(this).toggleClass('btn-success').toggleClass('btn-default');
            $.ajax({
                url: target,
                type: 'POST',
                data: { active: isActive },
                success: function() {
                    toastr.success("<?=lang('translation_updated_successfully')?>", "<?=lang('response_status')?>");
                },
                error: function(xhr) {
                    alert('Error: '+JSON.stringify(xhr));
                }
            });
        });

        $(".menu-view-toggle").on('click',function (e) {
            e.preventDefault();
            var target = $(this).attr('data-href');
            var role = $(this).attr('data-role');
            var vis = 1;
            if ($(this).hasClass('btn-success')) { vis = 0; }
            $(this).toggleClass('btn-success').toggleClass('btn-default');
            $.ajax({
                url: target,
                type: 'POST',
                data: { visible: vis, access: role },
                success: function() {},
                error: function(xhr) {}
            });
        });

        $(".cron-enabled-toggle").on('click',function (e) {
            e.preventDefault();
            var target = $(this).attr('data-href');
            var role = $(this).attr('data-role');
            var ena = 1;
            if ($(this).hasClass('btn-success')) { ena = 0; }
            $(this).toggleClass('btn-success').toggleClass('btn-default');
            $.ajax({
                url: target,
                type: 'POST',
                data: { enabled: ena, access: role },
                success: function() {},
                error: function(xhr) {}
            });
        });


        $('[data-rel=tooltip]').tooltip();
});
</script>
<?php }  ?>

<?php if (isset($iconpicker)) { ?>
<script type="text/javascript" src="<?=base_url()?>resource/js/iconpicker/fontawesome-iconpicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
            $('#site-icon').iconpicker({hideOnSelect: true, placement: 'bottomLeft'});
            $('.menu-icon').iconpicker().on('iconpickerSelected',function(event){
                var role = $(this).attr('data-role');
                var target = $(this).attr('data-href');
                $(this).siblings('div.iconpicker-container').hide();
                $.ajax({
                    url: target,
                    type: 'POST',
                    data: { icon: event.iconpickerValue, access: role  },
                    success: function() {},
                    error: function(xhr) {}
                });
            });
    });
</script>
<?php } ?>

<?php if (isset($sortable)) { ?>
<script type="text/javascript" src="<?=base_url()?>resource/js/sortable/jquery-sortable.js"></script>
<script type="text/javascript">
    var t1, t2, t3, t4, t5;
    $('#inv-details, #est-details').sortable({
        cursorAt: { top: 20, left: 0 },
        containerSelector: 'table',
        handle: '.drag-handle',
        revert: true,
        itemPath: '> tbody',
        itemSelector: 'tr.sortable',
        placeholder: '<tr class="placeholder"/>',
        afterMove: function() { clearTimeout(t1); t1 = setTimeout('saveOrder()', 500); }
    });
    $('#menu-admin').sortable({
        cursorAt: { top: 20, right: 20 },
        containerSelector: 'table',
        handle: '.drag-handle',
        revert: true,
        itemPath: '> tbody',
        itemSelector: 'tr.sortable',
        placeholder: '<tr class="placeholder"/>',
        afterMove: function() { clearTimeout(t2); t2 = setTimeout('saveMenu(\'admin\',1)', 500); }
    });
    $('#menu-client').sortable({
        cursorAt: { top: 20, right: 20 },
        containerSelector: 'table',
        handle: '.drag-handle',
        revert: true,
        itemPath: '> tbody',
        itemSelector: 'tr.sortable',
        placeholder: '<tr class="placeholder"/>',
        afterMove: function() { clearTimeout(t3); t3 = setTimeout('saveMenu(\'client\',2)', 500); }
    });
    $('#menu-staff').sortable({
        cursorAt: { top: 20, right: 20 },
        containerSelector: 'table',
        handle: '.drag-handle',
        revert: true,
        itemPath: '> tbody',
        itemSelector: 'tr.sortable',
        placeholder: '<tr class="placeholder"/>',
        afterMove: function() { clearTimeout(t4); t4 = setTimeout('saveMenu(\'staff\',3)', 500); }
    });
    $('#cron-jobs').sortable({
        cursorAt: { top: 20, left: 20 },
        containerSelector: 'table',
        handle: '.drag-handle',
        revert: true,
        itemPath: '> tbody',
        itemSelector: 'tr.sortable',
        placeholder: '<tr class="placeholder"/>',
        afterMove: function() { clearTimeout(t5); t5 = setTimeout('setCron()', 500); }
    });

    function saveOrder() {
        var data = $('.sorted_table').sortable("serialize").get();
        var items = JSON.stringify(data);
        var table = $('.sorted_table').attr('type');
        $.ajax({
            url: "<?=base_url()?>"+table+"/items/reorder/",
            type: "POST",
            dataType:'json',
            data: { json: items },
            success: function() { }
        });

    }
    function saveMenu(table, access) {
        var data = $("#menu-"+table).sortable("serialize").get();
        var items = JSON.stringify(data);
        $.ajax({
            url: "<?=base_url()?>settings/hook/reorder/"+access,
            type: "POST",
            dataType:'json',
            data: { json: items },
            success: function() { }
        });
    }

    function setCron() {
        var data = $('#cron-jobs').sortable("serialize").get();
        var items = JSON.stringify(data);
        $.ajax({
            url: "<?=base_url()?>settings/hook/reorder/1",
            type: "POST",
            dataType:'json',
            data: { json: items },
            success: function() { }
        });
    }
</script>
<?php } ?>

<?php if (isset($nouislider)) { ?>
<script type="text/javascript" src="<?=base_url()?>resource/js/nouislider/jquery.nouislider.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    var progress = $('#progress').val();
    $('#progress-slider').noUiSlider({
            start: [ progress ],
            step: 10,
            connect: "lower",
            range: {
                'min': 0,
                'max': 100
            },
            format: {
                to: function ( value ) {
                    return Math.floor(value);
                },
                from: function ( value ) {
                    return Math.floor(value);
                }
            }
    });
    $('#progress-slider').on('slide', function() {
        var progress = $(this).val();
        $('#progress').val(progress);
        $('.noUi-handle').attr('title', progress+'%').tooltip('fixTitle').parent().find('.tooltip-inner').text(progress+'%');
    });

    $('#progress-slider').on('change', function() {
        var progress = $(this).val();
        $('#progress').val(progress);
    });

    $('#progress-slider').on('mouseover', function() {
        var progress = $(this).val();
        $('.noUi-handle').attr('title', progress+'%').tooltip('fixTitle').tooltip('show');
    });

    var invoiceHeight = $('#invoice-logo-height').val();
    $('#invoice-logo-slider').noUiSlider({
            start: [ invoiceHeight ],
            step: 1,
            connect: "lower",
            range: {
                'min': 30,
                'max': 150
            },
            format: {
                to: function ( value ) {
                    return Math.floor(value);
                },
                from: function ( value ) {
                    return Math.floor(value);
                }
            }
    });
    $('#invoice-logo-slider').on('slide', function() {
        var invoiceHeight = $(this).val();
        var invoiceWidth = $('.invoice_image img').width();
        $('#invoice-logo-height').val(invoiceHeight);
        $('#invoice-logo-width').val(invoiceWidth);
        $('.noUi-handle').attr('title', invoiceHeight+'px').tooltip('fixTitle').parent().find('.tooltip-inner').text(invoiceHeight+'px');
        $('.invoice_image img').css('height',invoiceHeight+'px');
        $('#invoice-logo-dimensions').html(invoiceHeight+'px x '+invoiceWidth+'px');
    });

    $('#invoice-logo-slider').on('change', function() {
        var invoiceHeight = $(this).val();
        var invoiceWidth = $('.invoice_image img').width();
        $('#invoice-logo-height').val(invoiceHeight);
        $('#invoice-logo-width').val(invoiceWidth);
        $('.invoice_image').css('height',invoiceHeight+'px');
        $('#invoice-logo-dimensions').html(invoiceHeight+'px x '+invoiceWidth+'px');
    });

    $('#invoice-logo-slider').on('mouseover', function() {
        var invoiceHeight = $(this).val();
        $('.noUi-handle').attr('title', invoiceHeight+'px').tooltip('fixTitle').tooltip('show');
    });



});
</script>
<?php } ?>

<?php if (isset($calendar) || isset($fullcalendar)) { ?>
<?php $lang = lang('lang_code'); if ($lang == 'en') { $lang = 'en-gb'; } ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.9.1/fullcalendar.min.js"></script>
<script src="<?=base_url()?>resource/js/calendar/gcal.js"></script>
<script src="<?=base_url()?>resource/js/calendar/lang/<?=$lang?>.js"></script>
<?php if (isset($calendar)) { ?>
 <?=$this->load->view('sub_group/calendarjs')?>
<?php } ?>


<?php
if(User::is_staff()) :
$tasks = $this->db->select('*, fx_tasks.due_date as task_due, fx_tasks.start_date as task_start',TRUE)->join('assign_tasks','task_assigned = t_id')->where('assigned_user',User::get_id())->get('tasks')->result();
$projects = $this->db->join('assign_projects','project_assigned = project_id')
                  ->where('assigned_user',User::get_id())->get('projects')->result();

$events = $this->db->where('added_by',User::get_id())->get('events')->result();
else:

$tasks = $this->db->select('*, fx_tasks.due_date as task_due, fx_tasks.start_date as task_start',TRUE)->join('projects','project = project_id')->get('tasks')->result();
$payments = $this->db->join('invoices','invoice = inv_id')->join('companies','paid_by = co_id')->get('payments')->result();
$invoices = $this->db->join('companies','client = co_id')->get('invoices')->result();
$estimates = $this->db->join('companies','client = co_id')->get('estimates')->result();
$projects = $this->db->join('companies','client = co_id')->get('projects')->result();
$events = $this->db->get('events')->result();

endif;
$gcal_api_key = config_item('gcal_api_key');
$gcal_id = config_item('gcal_id');
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            googleCalendarApiKey: '<?=$gcal_api_key?>',
            header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
            eventAfterRender: function(event, element, view) {
                if (event.type == 'fo') {
                    $(element).attr('data-toggle', 'ajaxModal').addClass('ajaxModal');
                }
            },
            eventSources: [
                {
                    events: [
                    <?php foreach ($tasks as $t) { ?>
                            {
                                title  : '<?= addslashes($t->task_name) ?>',
                                start  : '<?= date('Y-m-d', strtotime($t->task_start)) ?>',
                                end: '<?= date('Y-m-d', strtotime($t->task_due)) ?>',
                                url: '<?= base_url('calendar/event/tasks/' . $t->t_id) ?>',
                                type: 'fo'
                            },
                    <?php } ?>
                    ],
                    color: '#529FE7',
                    textColor: 'white'
                },
                <?php if(User::is_admin()) : ?>
                {
                    events: [
                    <?php foreach ($payments as $p) { ?>
                            {
                                title  : '<?=addslashes($p->company_name)."  (".Applib::format_currency($p->currency, $p->amount).")"?>',
                                start  : '<?= date('Y-m-d', strtotime($p->payment_date)) ?>',
                                end: '<?= date('Y-m-d', strtotime($p->payment_date)) ?>',
                                url: '<?= base_url('calendar/event/payments/' . $p->p_id) ?>',
                                type: 'fo'
                            },
                    <?php } ?>
                    ],
                    color: '#FBBE59',
                    textColor: 'black'
                },<?php endif; ?>
                <?php if(User::is_admin()) : ?>
                {
                    events: [
                    <?php foreach ($invoices as $i) { ?>
                            {
                                title  : '<?=$i->reference_no." ".addslashes($i->company_name)?>',
                                start  : '<?= date('Y-m-d', strtotime($i->due_date)) ?>',
                                end: '<?= date('Y-m-d', strtotime($i->due_date)) ?>',
                                url: '<?= base_url('calendar/event/invoices/' . $i->inv_id) ?>',
                                type: 'fo'
                            },
                    <?php } ?>
                    ],
                    color: '#E27777',
                    textColor: 'white'
                },<?php endif; ?>
                <?php if(User::is_admin()) : ?>
                {
                    events: [
                    <?php foreach ($estimates as $e) { ?>
                            {
                                title  : '<?=$e->reference_no." ".addslashes($e->company_name)?>',
                                start  : '<?= date('Y-m-d', strtotime($e->due_date)) ?>',
                                end: '<?= date('Y-m-d', strtotime($e->due_date)) ?>',
                                url: '<?= base_url('calendar/event/estimates/' . $e->est_id) ?>',
                                type: 'fo'
                            },
                    <?php } ?>
                    ],
                    color: '#8E76C6',
                    textColor: 'white'
                },<?php endif; ?>
                {
                    events: [
                    <?php foreach ($projects as $j) { ?>
                            {
                                title  : '<?=addslashes($j->project_title)?>',
                                start  : '<?= date('Y-m-d', strtotime($j->start_date)) ?>',
                                end: '<?= date('Y-m-d', strtotime($j->due_date)) ?>',
                                url: '<?= base_url('calendar/event/projects/' . $j->project_id) ?>',
                                type: 'fo'
                            },
                    <?php } ?>
                    ],
                    color: '#6B6B6B',
                    textColor: 'white'
                },
                {
                    events: [
                    <?php foreach ($events as $e) { ?>
                            {
                                title  : '<?=addslashes($e->event_name)?>',
                                start  : '<?=date('Y-m-d', strtotime($e->start_date)) ?>',
                                end: '<?= date('Y-m-d', strtotime($e->end_date)) ?>',
                                url: '<?= base_url('calendar/event/events/' . $e->id) ?>',
                                type: 'fo',
                                color: '<?=$e->color?>'
                            },
                    <?php } ?>
                    ],
                    color: '#38354a',
                    textColor: 'white'
                },
                {
                    googleCalendarId: '<?=$gcal_id?>'
                }
            ]
        });
    });
</script>
<?php } ?>


<?php if (isset($set_fixed_rate)) { ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#fixed_rate").click(function(){
            //if checked
            if($("#fixed_rate").is(":checked")){
                $("#fixed_price").show("fast");
                $("#hourly_rate").hide("fast");
                }else{
                    $("#fixed_price").hide("fast");
                    $("#hourly_rate").show("fast");
                }
        });
    });
</script>
<?php } ?>

<?php if (isset($postmark_config)) { ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#use_postmark").click(function(){
            //if checked
            if($("#use_postmark").is(":checked")){
                $("#postmark_config").show("fast");
                }else{
                    $("#postmark_config").hide("fast");
                }
        });
        $("#use_alternate_emails").click(function(){
            //if checked
            if($("#use_alternate_emails").is(":checked")){
                $("#alternate_emails").show("fast");
                }else{
                    $("#alternate_emails").hide("fast");
                }
        });
    });
</script>
<?php } ?>

<?php if (isset($braintree_setup)) { ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#use_braintree").click(function(){
            //if checked
            if($("#use_braintree").is(":checked")){
                $("#braintree_setup").show("fast");
                }else{
                    $("#braintree_setup").hide("fast");
                }
        });
    });
</script>
<?php } ?>

<?php if (isset($attach_slip)) { ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#attach_slip").click(function(){
            //if checked
            if($("#attach_slip").is(":checked")){
                $("#attach_field").show("fast");
                }else{
                    $("#attach_field").hide("fast");
                }
        });
    });
</script>
<?php } ?>

<?php if (isset($task_checkbox)) { ?>
<script type="text/javascript">

$(document).ready(function() {

$('.task_complete input[type="checkbox"]').change(function() {

    var task_id = $(this).data().id;
    var task_complete = $(this).is(":checked");

    var formData = {
            'task_id'         : task_id,
            'task_complete'   : task_complete
        };
    $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '<?=base_url()?>projects/tasks/progress', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
        })
            // using the done promise callback
            .done(function(data) {

                 if ( ! data.success) {
                        alert('There was a problem with AJAX');
                    }else{
                        location.reload();
                    }

                // here we will handle errors and validation messages
            });

  });

});
</script>
<?php } ?>


<?php if (isset($todo_list)) { ?>
<script type="text/javascript">

$(document).ready(function() {

$('.todo_complete input[type="checkbox"]').change(function() {

    var id = $(this).data().id;
    var todo_complete = $(this).is(":checked");

    var formData = {
            'id'         : id,
            'todo_complete'   : todo_complete
        };
    $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '<?=base_url()?>projects/todo/status', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
            // using the done promise callback
            .done(function(data) {

                 if ( ! data.success) {
                        alert('There was a problem with AJAX');
                    }else{
                        location.reload();
                    }

                // here we will handle errors and validation messages
            });

  });

});
</script>
<?php } ?>

 <?php
if($this->session->flashdata('message')){
$message = $this->session->flashdata('message');
$alert = $this->session->flashdata('response_status'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        swal({
            title: "<?=lang($alert)?>",
            text: "<?=$message?>",
            type: "<?=$alert?>",
            timer: 5000,
            confirmButtonColor: "#38354a"
        });
});
</script>
<?php } ?>

<?php if (isset($typeahead)) { ?>
<script type="text/javascript">
    $(document).ready(function(){

        var scope = $('#auto-item-name').attr('data-scope');
        if (scope == 'invoices' || scope == 'estimates') {

        var substringMatcher = function(strs) {
          return function findMatches(q, cb) {
            var substrRegex;
            var matches = [];
            substrRegex = new RegExp(q, 'i');
            $.each(strs, function(i, str) {
              if (substrRegex.test(str)) {
                matches.push(str);
              }
            });
            cb(matches);
          };
        };

        $('#auto-item-name').on('keyup',function(){ $('#hidden-item-name').val($(this).val()); });

        $.ajax({
            url: base_url + scope + '/autoitems/',
            type: "POST",
            data: {},
            success: function(response){
                $('.typeahead').typeahead({
                    hint: true,
                    highlight: true,
                    minLength: 2
                    },
                    {
                    name: "item_name",
                    limit: 10,
                    source: substringMatcher(response)
                });
                $('.typeahead').bind('typeahead:select', function(ev, suggestion) {
                    $.ajax({
                        url: base_url + scope + '/autoitem/',
                        type: "POST",
                        data: {name: suggestion},
                        success: function(response){
                            $('#hidden-item-name').val(response.item_name);
                            $('#auto-item-desc').val(response.item_desc).trigger('keyup');
                            $('#auto-quantity').val(response.quantity);
                            $('#auto-unit-cost').val(response.unit_cost);
                        }
                    });
                });
            }
        });
    }


    });
</script>
<?php } ?>

<?php if (isset($gantt)) { ?>

<script src="<?=base_url()?>resource/js/charts/gantt/jquery.fn.gantt.js"></script>

<script>
$(".gantt").gantt({
    source: [
    <?php
    if(!User::is_client()){
    $tasks = $this->db->order_by('t_id','desc')->where(array('project'=>$project))->get('tasks')->result();
    }else{
    $tasks = $this->db->order_by('t_id','desc')->where(array('project'=>$project,'visible'=>'Yes'))->get('tasks')->result();
    }
    foreach ($tasks as $key => $t) { $start_date = ($t->start_date == NULL) ? $t->date_added : $t->start_date; ?>
{
  "name": '<a href="<?=site_url()?>projects/view/<?=$project?>?group=tasks&view=task&id=<?=$t->t_id?>" class="text-info"><?=addslashes($t->task_name)?> </a>',
  "desc": "",
  "values": [
            {"from":  Date.parse("<?=date('Y/m/d',strtotime($start_date))?>"), "to": Date.parse("<?=date('Y/m/d',strtotime($t->due_date))?>"),
            "desc": "<b><?=$t->task_name?></b> - <em><?=$t->task_progress?>% <?=lang('done')?></em><br><div class=\"line line-dashed line-lg pull-in\"></div><em><?=lang('start_date')?>: <span class=\"text-success text-small\"><?=strftime(config_item('date_format'), strtotime($start_date));?></span> to <?=lang('due_date')?>: <span class=\"text-danger text-small\"><?=strftime(config_item('date_format'), strtotime($t->due_date));?></span></em>",
            "customClass": '<?php if($t->task_progress == '100'){ echo "ganttGreen"; }else{ echo "ganttRed"; } ?>', "label": "<?=$t->task_name?>"
            }
  ]
},
<?php } ?>
],

    maxScale: "months",
    itemsPerPage: 25,
});
</script>
<?php } ?>
<script type="text/javascript">
   $(document).ready(function() {

    $('.clickable tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});
</script>
