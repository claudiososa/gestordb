(function(  ) {
  var timePickerId = 'mat-timepicker';
  var timePickerHourId = 'mat-timepicker-hour';
  var timePickerMinuteId = 'mat-timepicker-minute';
  var timePickerHourSelectId = 'mat-timepicker-hour-select';
  var timePickerMinuteSelectId = 'mat-timepicker-minute-select';
  var currentInput = null;
  var lastHoverdTime = null;
  var isHourFaceVisible = true;

  window.onload = function (  ) {
    init( );
  }

  var onTimeTouchEnd = function( ) {
    if ( lastHoverdTime ) {
      switchTimepickerInput( false );
    }
    lastHoverdTime = null;
  }

  var onMinuteTouchMove = function( event ) {
    var el = document.elementFromPoint( event.targetTouches[ 0 ].pageX, event.targetTouches[ 0 ].pageY );
    if ( el.className === 'MatTimePicker-WatchMinuteContainer' ) {
      lastHoverdTime = parseInt( el.getAttribute( 'minute' ) );
      setMinute( lastHoverdTime, true );
    }
  }

  var onHourTouchMove = function( event ) {
    var el = document.elementFromPoint( event.targetTouches[ 0 ].pageX, event.targetTouches[ 0 ].pageY );
    if ( el.className === 'MatTimePicker-WatchHourBg' ) {
      lastHoverdTime = parseInt( el.getAttribute( 'hour-value' ) );
      setHour( lastHoverdTime, true );
    }
  }

  var onSetHourClick = function( event ) {
    setHour( parseInt( event.currentTarget.getAttribute( 'hour' ) ), true );
    switchTimepickerInput( false );
  }

  var setHour = function ( hour, isSelected ) {
    var timepicker = document.getElementById( timePickerId );
    var hourEl = document.getElementById( timePickerHourId );
    hourEl.innerHTML = ( hour < 10 ? '0' : '' ) + hour;
    hourEl.className = isSelected ? 'MatTimePicker-TimeHeader-Selected' : '';
    [].slice.call( timepicker.getElementsByClassName( 'MatTimePicker-WatchHourContainer' ) ).map( function ( element ) {
      element.className = element.className.replace( ' MatTimePicker-HourSelected', '' );
      if( parseInt( element.getAttribute( 'hour' ) ) === hour ) {
        element.className += ' MatTimePicker-HourSelected';
      }
    } );
  }

  var onSetMinuteClick = function ( event ) {
    setMinute( parseInt( event.currentTarget.getAttribute( 'minute' ) ), true );
  }

  var setMinute = function ( minute, isSelected ) {
    var timepicker = document.getElementById( timePickerId );
    var minuteEl = document.getElementById( timePickerMinuteId );
    minuteEl.innerHTML = (  minute < 10 ? '0' : '' ) + minute;
    minuteEl.className = isSelected ? 'MatTimePicker-TimeHeader-Selected' : '';
    [].slice.call( timepicker.getElementsByClassName( 'MatTimePicker-WatchMinuteContainer' ) ).map( function ( element ) {
      element.className = element.className.replace( ' MatTimePicker-HourSelected', '' );
      if( parseInt( element.getAttribute( 'minute' ) ) === minute ) {
        element.className += ' MatTimePicker-HourSelected';
      }
    } );
  }

  var onCancelClick = function ( ) {
    currentInput = null;
    document.getElementById( timePickerId ).style.display = 'none';
  }

  var onOkClick = function ( ) {
    document.getElementById( timePickerId ).style.display = 'none';
    var time = document.getElementById( timePickerHourId ).innerHTML + ':' + document.getElementById( timePickerMinuteId ).innerHTML
    currentInput.value = time;
  }

  var onShowTimepickerClick = function( event ) {
    currentInput = event.currentTarget;
    currentInput.blur( );
    var hours = minutes = 0;
    try {
      var timeValue = currentInput.getAttribute( 'value' ).split( ':' );
      hours = parseInt( timeValue[ 0 ] );
      minutes = parseInt( timeValue[ 1 ] );
    } catch ( e ) {
      hours = new Date().getHours();
      minutes = new Date().getMinutes();
    }
    setHour( hours );
    setMinute( minutes );
    switchTimepickerInput( true );
    document.getElementById( timePickerId ).style.display = 'flex';
  }

  var onShowHourTimepickerClick = function ( ) {
    switchTimepickerInput( true );
  }

  var onShowMinuteTimepickerClick = function ( ) {
    switchTimepickerInput( false );
  }

  var switchTimepickerInput = function ( isHour ) {
    isHourFaceVisible = isHour;
    document.getElementById( isHour ? timePickerHourId : timePickerMinuteId ).className = 'MatTimePicker-TimeHeader-Selected';
    document.getElementById( isHour ? timePickerMinuteId : timePickerHourId ).className = '';
    document.getElementById( timePickerHourSelectId ).style.opacity = document.getElementById( timePickerHourSelectId ).style.zIndex = isHour ? 1 : 0;
    document.getElementById( timePickerMinuteSelectId ).style.opacity = document.getElementById( timePickerMinuteSelectId ).style.zIndex = isHour ? 0 : 1;
  }

  var init = function( ) {
    [].slice.call( document.querySelectorAll('[type="mat-timepicker"]') ).map( function( input ) {
      input.addEventListener( 'click', onShowTimepickerClick );
    } );

    var elTimepicker = createElement( 'div', 'MatTimePicker-Clock', timePickerId );
    var elPopup = createElement( 'div', 'MatTimePicker-Popup' + ( 'ontouchstart' in document.documentElement ? ' hasTouch' : '' ) );
    elTimepicker.appendChild( elPopup );
    var elHeader = createElement( 'div', 'MatTimePicker-TimeHeader' );
    elPopup.appendChild( elHeader );

    var elHour = createElement( 'span', null, timePickerHourId, '00' );
    elHour.addEventListener( 'click', onShowHourTimepickerClick );
    elHeader.appendChild( elHour );
    var elColon = createElement( 'span', null, null, ':' );
    elHeader.appendChild( elColon );
    var elMinute = createElement( 'span', null, timePickerMinuteId, '00' );
    elMinute.addEventListener( 'click', onShowMinuteTimepickerClick );
    elHeader.appendChild( elMinute );
    var elWatchContainer = createElement( 'div', 'MatTimePicker-WatchContainer' );
    elPopup.appendChild( elWatchContainer );

    var elWatch = createElement( 'div', 'MatTimePicker-Watch' );
    elWatchContainer.appendChild( elWatch );
    var elHourSelect = createElement( 'div', 'MatTimePicker-WatchFace', timePickerHourSelectId );
    elHourSelect.addEventListener( 'touchmove', onHourTouchMove );
    elHourSelect.addEventListener( 'touchend', onTimeTouchEnd );
    elWatch.appendChild( elHourSelect );
    var elMinuteSelect = createElement( 'div', 'MatTimePicker-WatchFace', timePickerMinuteSelectId );
    elMinuteSelect.style.opacity = 0;
    elMinuteSelect.addEventListener(  'touchmove', onMinuteTouchMove );
    elMinuteSelect.addEventListener(  'touchend', onTimeTouchEnd );
    elWatch.appendChild( elMinuteSelect );

    var elButtons = createElement( 'div', 'MatTimePicker-Buttons' );
    elWatchContainer.appendChild( elButtons );
    var elButtonCancel = createElement( 'button', 'MatTimePicker-Button', null, 'CANCEL' );
    elButtonCancel.addEventListener( 'click', onCancelClick );
    elButtons.appendChild( elButtonCancel );
    var elButtonOk = createElement( 'button', 'MatTimePicker-Button', null, 'OK' );
    elButtonOk.addEventListener( 'click', onOkClick );
    elButtons.appendChild( elButtonOk );

    initWatchHours( elHourSelect );
    initWatchMinutes( elMinuteSelect );

    document.body.insertBefore( elTimepicker, document.body.children[ 0 ] );
  }

  function initWatchHours( elWatch ) {
    for( var h = 24; h > 0; h-- ) {
      var hourContainer = createElement( 'div', 'MatTimePicker-WatchHourContainer' + ( h > 12 ? ' MatTimePicker-WatchHourPM' : '' ) );
      var rotation = ( -90 + ( 360/12 * h ) );
      hourContainer.style.transform = 'rotate(' + rotation + 'deg)';
      hourContainer.setAttribute( 'hour', h % 24 );
      hourContainer.addEventListener( 'click', onSetHourClick );
      elWatch.appendChild( hourContainer );

      var centerDot = createElement( 'div', 'MatTimePicker-WatchCenterDot' );
      hourContainer.appendChild( centerDot );
      var stick = createElement( 'div', 'MatTimePicker-WatchStick' );
      hourContainer.appendChild( stick );

      var hour = createElement( 'div', 'MatTimePicker-WatchHour' );
      hourContainer.appendChild( hour );
      var hourBg = createElement( 'div', 'MatTimePicker-WatchHourBg' );
      hourBg.setAttribute( 'hour-value', h % 24 );
      hour.appendChild( hourBg );
      var hourValue = createElement( 'div', 'MatTimePicker-WatchHourValue', null, h % 24 );
      hourValue.style.transform = 'rotate(' + ( rotation * -1 ) + 'deg)';
      hour.appendChild( hourValue );
    }
  }

  function initWatchMinutes( elWatch ) {
    for ( var i = 0; i < 2; i++ ) {
      for( var m = 0; m < 60; m++ ) {
        var minute = m % 60;
        if ( ( i == 0 && m % 5 !== 0 ) || ( i == 1 && m % 5 === 0 ) ) {
          var minuteContainer = createElement( 'div', 'MatTimePicker-WatchMinuteContainer' );
          var rotation = ( -90 + ( 360/60 * m ) );
          minuteContainer.style.transform = 'rotate(' + rotation + 'deg)';
          minuteContainer.setAttribute( 'minute', m );
          minuteContainer.addEventListener( 'click', onSetMinuteClick );
          elWatch.appendChild( minuteContainer );

          var centerDot = createElement( 'div', 'MatTimePicker-WatchCenterDot' );
          minuteContainer.appendChild( centerDot );
          var stick = createElement( 'div', 'MatTimePicker-WatchStick' );
          minuteContainer.appendChild( stick );

          var minute = createElement( 'div', 'MatTimePicker-WatchMinute' );
          minuteContainer.appendChild( minute );
          var minuteBg = createElement( 'div', 'MatTimePicker-WatchHourBg' );
          minute.appendChild( minuteBg );
          if ( m % 5 === 0 ) {
            var minuteValue = createElement( 'div', 'MatTimePicker-WatchHourValue', null, m );
            minuteValue.style.transform = 'rotate(' + ( rotation * -1 ) + 'deg)';
            minute.appendChild( minuteValue );
          }
        }
      }
    }
  }

  function createElement( type, className, id, innerHTML ) {
    var el = document.createElement( type );
    if ( className ) el.className = className;
    if ( id ) el.id = id;
    if ( typeof innerHTML !== 'undefined' ) el.innerHTML = innerHTML;
    return el;
  }
} )( );
