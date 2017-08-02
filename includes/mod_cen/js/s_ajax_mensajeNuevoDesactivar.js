<script type="text/javascript">
//<![CDATA[
  var area1, area2;

  function toggleArea1() {
        if(!area1) {
                area1 = new nicEditor({fullPanel : true}).panelInstance('myArea1',{hasPanel : true});
        } else {
                area1.removeInstance('myArea1');
                area1 = null;
        }
  }

  function addArea2() {
        area2 = new nicEditor({fullPanel : true}).panelInstance('myArea2');
  }
  function removeArea2() {
        area2.removeInstance('myArea2');
  }

  bkLib.onDomLoaded(function() { toggleArea1(); });
  //]]>
  </script>
