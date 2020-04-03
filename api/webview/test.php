<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="Generator" content="EditPlus®">
        <meta name="Author" content="">
        <meta name="Keywords" content="">
        <meta name="Description" content="">
		<meta name="viewport" content="initial-scale=1, width=device-width">
        <title>Document</title>
    </head>

    <script>
        function buttonClick() {
            alert('interface : masicgong.callTest() 를 호출합니다. ');
            window.masicgong.callTest();
        }

		function focusEvent() {
			setCalendar(' interface : masicgong.callbackTest() 를 호출합니다.  ');
		}
		
		function setCalendar( arg_data ) {
			document.getElementById('test_calendar').value = arg_data;
			window.masicgong.callbackTest('setCalendar');
		}

    </script>

    <body>

        <div style="width:100% ">
            <div style="width:500px;margin:20% auto">
                <button type="button" onclick="buttonClick()" >탭 하시오</button>
            </div> 
			
			<div style="width:500px;margin:0 auto">
                <input type="text" name="test_calendar" id="test_calendar" onfocus="focusEvent()" style="width:100%" >
            </div> 

        </div>

    </body>
</html>


