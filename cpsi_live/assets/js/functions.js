
///////////////////////////////////////////////////////////////////////////////////////////////////
// JQUERY EVENTS

// When the DOM is loaded trigger jquery functions
$(document).ready(function () {
    
    
     //Add new emergency plan
  
    // Listen for focus and blur events to clear or replace default text on login username textbox
    $('#username').on('focus blur', function () {
        if (this.value == 'Enter Username') {
            this.value = '';
        } else if (this.value == '') {
            this.value = '';
        }
    });

//    // Listen for password element focus and blur events to clear or replace default text and change type of input element
//    $('#password').on('focus blur', function () {
//        if (this.value == 'Enter Password') {
//            this.value = '';
//            this.type = 'password';
//        } else if (this.value == '') {
//            this.value = '';
//            this.type = 'password';
//        } 
//    });

    // Listen for focus and blur events to clear or replace default text on search textbox
//    $('#main-search')
//        .on('focus', function () {
//            if (this.value == 'Enter SIF # to find a student')
//                this.value = '';
//        })
//        .on('blur', function () {
//            if (this.value == '')
//                this.value = 'Enter SIF # to find a student';
//        });

    // Listen for focus and blur events to clear or replace default text on search textbox
//    $('#top-search')
//        .on('focus', function () {
//            if (this.value == 'Enter SIF # to find a student')
//                this.value = '';
//        })
//        .on('blur', function () {
//            if (this.value == '')
//                this.value = 'Enter SIF # to find a student';
//        });

    // Listen for focus and blur events to clear or replace default text on search textbox
    $('#filter1, #filter2')
        .on('focus', function () {
            if (this.value == 'Enter search filter...')
                this.value = '';
        })
        .on('blur', function () {
            if (this.value == '')
                this.value = 'Enter search filter...';
        });

    // Toggle the advanced features of the search page to show or hide them
    $('#advanced-button').on('click', function () {
        $(this).toggleClass('hover');
        $('#advanced').toggleClass('on off');
    });

    // Validate the form
    $('#sif, #confirmsif').on('keyup', sifLookup );

    $('#confirmstatenum').on('keyup', function () {
        if (this.value == $('#statenum').val()) {
            $(this).removeClass('error').addClass( 'valid' );
            $('#statenum').removeClass('error').addClass('valid');
        } else {
            $(this).removeClass('valid').addClass('error');
            $('#statenum').removeClass('valid').addClass('error');
        }
    });

    $('#schooltype').on('change', function () {
        getSchools(this.value);
    });
    

    $('#contactattempt0').datepicker();
//    $('#reevaldate').datepicker();
    $('#prevdate').datepicker();
    $('#releaseexp').datepicker();
    $('#lastexam').datepicker();
    $('#nextexam').datepicker();
    $('#releaseexp0').datepicker();
    $('#lastexam0').datepicker();
    $('#nextexam0').datepicker();
//    $('#dentalexam').datepicker();
//    $('#hearingexam').datepicker();
//    $('#visionexam').datepicker();

//    $('#lastseizureexam').datepicker();
//    $('#shuntplacement').datepicker();
//    $('#lastrevision').datepicker();
//    $('#lastseizure').datepicker();

    $('#scolast').datepicker();
    $('#hiplast').datepicker();

    $('#swallowdate').datepicker();

    $('#newtreatment').on('click', function () {
        var count = $('#section5 section').length - 1;
        $('#section5').append('<section><label for="treatment' + count + '">Treatment Order</label><input type="text" id="treatment' + count + '" name="treatment'
            + count + '" /><label for="frequency' + count + '">Frequency</label><input type="text" id="frequency' + count + '" name="frequency'
            + count + '" /><label for="taken' + count + '">Peformed:</label><span class="inline"><input type="checkbox" value="At School" id="performedschool'
            + count + '" name="performedschool' + count + '" /> <label for="performedschool'
            + count + '"><span></span>At School</label></span><span class="inline"><input type="checkbox" value="At Home" id="performedhome'
            + count + '" name="performedhome' + count + '" /> <label for="performedhome' + count + '"><span></span>At Home</label></span><label for="person'
            + count + '">Person Performing</label><input type="text" id="person' + count + '" name="person' + count + '" /></section>');
    });

    $('#newallergy').on('click', function () {
        var count = ($('#section6 section').length - 1)/3;
        $('#section6').append('<section><label for="allergy' + count + '">Allergic to</label><input type="text" id="allergy' + count + '" name="allergy'
            + count + '" /><label for="reaction' + count + '">Reaction</label><input type="text" id="reaction' + count + '" name="reaction'
            + count + '" /><label for="deadly">Life Threatening?</label><span class="inline"><input type="checkbox" value="Yes" id="deadlyyes'
            + count + '" name="deadlyyes' + count + '" /> <label for="deadlyyes'
            + count + '"><span></span>Yes</label></span><span class="inline"><input type="checkbox" value="No" id="deadlyno' + count + '" name="deadlyno'
            + count + '" /> <label for="deadlyno' + count + '"><span></span>No</label></span><label for="sensitivity'
            + count + '">Sensitivity Level</label><div class="check-group"><span class="inline"><input type="checkbox" value="Touch/Contact" id="touch'
            + count + '" name="touch' + count + '" /> <label for="touch'
            + count + '"><span></span>Touch/Contact</label></span><span class="inline"><input type="checkbox" value="Ingest" id="ingest'
            + count + '" name="ingest' + count + '" /> <label for="ingest'
            + count + '"><span></span>Ingestion</label></span><span class="inline"><input type="checkbox" value="Air" id="air'
            + count + '" name="air' + count + '" /> <label for="air' + count + '"><span></span>Air</label></span></div></section><section><label for="treatment'
            + count + '">Treatment</label><span class="inline"><input type="checkbox" value="Epi Pen" id="epi' + count + '" name="epi'
            + count + '" /> <label for="epi'
            + count + '"><span></span>Epi Pen</label></span><span class="inline"><input type="checkbox" value="Antihistamine" id="antihistamine'
            + count + '" name="antihistamine' + count + '" /> <label for="antihistamine' + count + '"><span></span>Antihistamine</label></span><label for="ah'
            + count + '">Which Antihistamine?</label><input type="text" id="ah' + count + '" name="ah' + count + '" /><label for="diagnosed'
            + count + '">How was the allergy diagnosed?</label><div class="check-group"><span class="inline"><input type="checkbox" value="Exposure" id="exposure'
            + count + '" name="exposure' + count + '" /> <label for="exposure'
            + count + '"><span></span>Exposure</label></span><span class="inline"><input type="checkbox" value="Allergy Testing and Exposure" id="testingexposure'
            + count + '" name="testingexposure' + count + '" /> <label for="testingexposure'
            + count + '"><span></span>Allergy Testing and Exposure</label></span><span class="inline"><input type="checkbox" value="Allergy Testing/Never Exposed" id="testing'
            + count + '" name="testing' + count + '" /> <label for="testing' + count + '"><span></span>Allergy Testing/Never Exposed</label></span></div><label for="lastevent'
            + count + '">Last Event</label><input type="text" id="lastevent' + count + '" name="lastevent' + count + '"></section><section class="largetext"><label for="addtnlcomments'
            + count + '">Additional Comments</label><textarea id="addtnlcomments' + count + '" name="addtnlcomments' + count + '"></textarea></section>');
    });
   
    $('#newdaily').on('click', function () {
         
        var count = $('#section3 section').length - 1;
        
        $('#section3').append('<section><label for="med' + count + '">Medication Name</label><input type="text" id="med' + count + '" name="med' + count + '" /><label for="dose'
            + count + '">Dosage</label><input type="text" id="dose' + count + '" name="dose' + count + '" /><label for="time' + count + '">Time/Frequency</label><input type="text" id="time'
            + count + '" name="time' + count + '" /><label for="route' + count + '">Route</label><input type="text" id="route' + count + '" name="route' + count + '" /><label for="taken'
            + count + '">Taken:</label><span class="inline"><input type="checkbox" value="At School" id="takenschool'
            + count + '" name="takenschool' + count + '" /> <label for="takenschool'
            + count + '"><span></span>At School</label></span><span class="inline"><input type="checkbox" value="At Home" id="takenhome'
            + count + '" name="takenhome' + count + '" /> <label for="takenhome' + count + '"><span></span>At Home</label></span></section>');
    });

    $('#newprn').on('click', function () {
      
        var count = $('#section4 section').length - 1;
        $('#section4').append('<section><label for="prnmed' + count + '">Medication Name</label><input type="text" id="prnmed' + count + '" name="prnmed' + count + '" /><label for="prndose'
            + count + '">Dosage</label><input type="text" id="prndose' + count + '" name="prndose' + count + '" /><label for="prntime' + count + '">Time/Frequency</label><input type="text" id="prntime'
            + count + '" name="prntime' + count + '" /><label for="prnroute' + count + '">Route</label><input type="text" id="prnroute' + count + '" name="prnroute' + count + '" /><label for="prntaken'
            + count + '">Taken:</label><div class="check-group"><span class="inline"><input type="checkbox" value="At School" id="prntakenschool'
            + count + '" name="prntakenschool' + count + '" /> <label for="prntakenschool' + count + '"><span></span>At School</label></span><span class="inline"><input type="checkbox" value="At Home" id="prntakenhome'
            + count + '" name="prntakenhome' + count + '" /> <label for="prntakenhome' + count + '"><span></span>At Home</label></span><span class="inline"><input type="checkbox" value="In Emergency" id="prntakenemergency'
            + count + '" name="prntakenemergency' + count + '" /> <label for="prntakenemergency' + count + '"><span></span>In Emergency</label></span></div></section>');
    });

    $('#newagency').on('click', function () {
        var count = $('#section2 section').length - 1;
        $('#section2').append('<section><label for="agencyname' + count + '">Name</label><input type="text" id="agencyname' + count + '" name="agencyname'
            + count + '" /><label for="agencyphone' + count + '">Phone</label><input type="text" id="agencyphone' + count + '" name="agencyphone'
            + count + '" /><label for="agencyfax' + count + '">Fax</label><input type="text" id="agencyfax' + count + '" name="agencyfax'
            + count + '" /><label for="agencyrelease' + count + '">Release?</label><span class="inline"><input type="checkbox" value="Yes" id="agencyyes'
            + count + '" name="agencyyes' + count + '" /> <label for="agencyyes' + count + '"><span></span>Yes</label></span><span class="inline"><input type="checkbox" value="No" id="agencyno'
            + count + '" name="agencyno' + count + '" /> <label for="agencyno' + count + '"><span></span>No</label></span></section>');
    });
    $('#newagency').on('click', function () {
        var count = $('#section2 section').length - 1;
        $('#section2').append('<section><label for="agencyname' + count + '">Name</label><input type="text" id="agencyname' + count + '" name="agencyname'
            + count + '" /><label for="agencyphone' + count + '">Phone</label><input type="text" id="agencyphone' + count + '" name="agencyphone'
            + count + '" /><label for="agencyfax' + count + '">Fax</label><input type="text" id="agencyfax' + count + '" name="agencyfax'
            + count + '" /><label for="agencyrelease' + count + '">Release?</label><span class="inline"><input type="checkbox" value="Yes" id="agencyyes'
            + count + '" name="agencyyes' + count + '" /> <label for="agencyyes' + count + '"><span></span>Yes</label></span><span class="inline"><input type="checkbox" value="No" id="agencyno'
            + count + '" name="agencyno' + count + '" /> <label for="agencyno' + count + '"><span></span>No</label></span></section>');
    });

    $('#newspecialist').on('click', function () {
        var count = $('#addspecialist section').length - 2;
        $('#addspecialist').append('<section><label for="specialist' + count + '">Specialist</label><input type="text" id="specialist'
            + count + '" name="specialist' + count + '" /><label for="lastexam' + count + '">Last Exam</label><input type="text" id="lastexam'
            + count + '" name="lastexam' + count + '" /><label for="nextexam' + count + '">Next Exam</label><input type="text" id="nextexam'
            + count + '" name="nextexam' + count + '" /><label for="phone' + count + '">Phone</label><input type="text" id="phone'
            + count + '" name="phone' + count + '" /><label for="fax' + count + '">Fax</label><input type="text" id="fax'
            + count + '" name="fax' + count + '" /><label for="release' + count + '">Release?</label><span class="inline"><input type="checkbox" value="Yes" id="releaseyes'
            + count + '" name="releaseyes' + count + '" /> <label for="releaseyes' + count + '"><span></span>Yes</label></span><span class="inline"><input type="checkbox" value="No" id="releaseno'
            + count + '" name="releaseno' + count + '" /> <label for="releaseno' + count + '"><span></span>No</label></span><label for="releaseexp'
            + count + '">Release Expiration</label><input type="text" id="releaseexp' + count + '" name="releaseexp' + count + '" /></section>');
        $('#releaseexp' + count).datepicker();
        $('#lastexam' + count).datepicker();
        $('#nextexam' + count).datepicker();
        
    });

    $('#attempt').on('click', function () {
     
        if ($('#contactattempt').attr('disabled') != 'disabled') {
            var count = $('#moredates').children().length + 1;
            $('#moredates').append('<input type="text" id="contactattempt' + count + '" name="contactattempt' + count + '" />');
            $('#contactattempt' + count).datepicker();
        }
    });

    $('#newdiagnosis').on('click', function () {
        var count = $('#diagnoses input').length;
        $('#diagnoses').append('<input type="text" id="diagnosis' + count + '" name="diagnosis' + count + '" class="long" />');
    });

    $('#previous').on('click', function () {
        progressbar(true, 'Saving...');
        $.ajax({
            type: 'POST',
            url: '/index.php/forms/save',
            data: $('form').serialize(),
            success: function (data) {
                console.log(data);
                progressbar(false);
                window.location.href = '/index.php/forms/' + prevkeys[$('#wizkey').val()] + '/' + data.ID + '/' + data.StudentID;
            },
            error: function (data) {
                console.log(data);
                progressbar(false);
            },
            dataType: 'json'
        });
        return false;
    });

    $('#next').on('click', function () {
        progressbar(true, 'Saving...');
        $.ajax({
            type: 'POST',
            url: '/index.php/forms/save',
            data: $('form').serialize(),
            success: function (data) {
                console.log(data);
                progressbar(false);
                window.location.href = '/index.php/forms/' + nextkeys[$('#wizkey').val()] + '/' + data.ID + '/' + data.StudentID;
            },
            error: function(data) {
                console.log(data);
                progressbar(false);
            },
            dataType: 'json'
        });
        return false;
    });

    $('#save').on('click', function () {
        progressbar(true, 'Saving...');
        $.ajax({
            type: 'POST',
            url: '/index.php/forms/save',
            data: $('form').serialize(),
            success: function (data) {
                console.log(data);
                progressbar(false);
            },
            error: function (data) {
                console.log(data);
                progressbar(false);
            },
            dataType: 'json'
        });
        return false;
    });
});

var nextkeys = { wiz001: 'wiz002', wiz002: 'wiz003', wiz003: 'wiz004', wiz004: 'wiz005', wiz005: 'wiz006', wiz006: 'wiz007', wiz007: 'wiz008', wiz008: 'wiz009',
    wiz009: 'wiz010', wiz010: 'wiz011', wiz011: 'wiz012', wiz012: 'wiz013', wiz013: 'wiz014', wiz014: 'wiz015', wiz015: 'wiz016', wiz016: 'wiz017' }

var prevkeys = { wiz002: 'wiz001', wiz003: 'wiz002', wiz004: 'wiz003', wiz005: 'wiz004', wiz006: 'wiz005', wiz007: 'wiz006', wiz008: 'wiz007', wiz009: 'wiz008',
    wiz010: 'wiz009', wiz011: 'wiz010', wiz012: 'wiz011', wiz013: 'wiz012', wiz014: 'wiz013', wiz015: 'wiz014', wiz016: 'wiz015', wiz017: 'wiz016' }

function sifLookup() {
    var othersif;
    if (this.id != $('#sif').attr('id')) {
        othersif = $('#sif');
    } else {
        othersif = $('#confirmsif');
    }

    if ( this.value == othersif.val() && this.value == '' ) {
        $(this).removeClass('valid').removeClass('error');
        othersif.removeClass('valid').removeClass('error');
        resetForm();
    } else if (this.value == othersif.val()) {
        $(this).off('keyup');
        $(this).removeClass('error').addClass( 'valid' );
        othersif.removeClass('error').addClass('valid');
        console.log(this.id);
        getStudent(this.value);
    } else {
        $(this).removeClass('valid').addClass('error');
        othersif.removeClass('valid').addClass('error');
    }
}

function progressbar( enable, text ) {
    var bar = $('#progressbar');
    if (enable) {
        if (text) {
            bar.find( '.progress-label').text(text);
        }

        bar.css('top', ($(window).height() - bar.outerHeight())/2 + $(window).scrollTop());
        bar.css('left', ($(window).width() - bar.outerWidth())/2 + $(window).scrollLeft());
        bar.progressbar({ value: false });
        bar.show();
    } else {
        bar.hide();
    }
}

function resetForm(enable) {
    if (enable) {
        $('input, button, select').removeAttr('disabled');
    } else {
        $('input, button, select').not('#sif, #confirmsif').attr('disabled', 'disabled');
        $('#moredates').empty();
    }

    $('input').not('#sif, #confirmsif, :hidden, :checkbox').val('');
    $(':checkbox').attr('checked', false);
}

function getSchools(typeid, id) {
    $.ajax({
        type: 'POST',
        url: '/index.php/forms/schools',
        data: 'typeid=' + typeid,
        success: function (data) {
            console.log(data);
            $('#school').empty();
            $('#school').append('<option value="0">--Choose One--</option>');
            for (var i=0,l = data.length; i < l; ++i ) {
                $('#school').append('<option value="' + data[i]['ID'] + '">' + data[i]['Name'] + '</option>');
            }
            $('#school').val(id);
        },
        dataType: 'json'
    });
}

function getStudent(sif) {
    $.ajax({
        type: 'POST',
        url: '/index.php/forms/student',
        data: 'sif=' + sif,
        success: function ( data ) {
            console.log(data);
            resetForm(true);
            var count = 1;
            while (data['contactattempt' + count] != null) {
               
                if ($('#contactattempt' + count).length == 0) {
                    $('#moredates').append('<input type="text" id="contactattempt' + count + '" />');
                    $('#contactattempt' + count).datepicker();
                }
                ++count;
            }
            for( var p in data ) {
                var el = $('#' + p);
                if (el.length && el.is(':checkbox')) {
                    el.prop('checked', data[p]);
                } else {
                    el.val(data[p]);
                }
            }

            getSchools($('#schooltype').val(), data['school']);

            $('#sif, #confirmsif').on('keyup', sifLookup);
        },
        dataType: 'json'
    });
}
