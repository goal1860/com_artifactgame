
  /**
   * @description General filter function for attack, armor, health, mana
   */
  function filterFunction(...arguments) {
    const args = arguments[0];
    const attackOpt = $(args[0]).val();
    const checkValue = parseInt($(args[1]).val());
    if (attackOpt === '6') {
      $(args[3]).removeClass('hide');
    } else {
      $(args[3]).addClass('hide');
    }
    if (isNaN(checkValue)) {
      args[5].draw();
    } else if (attackOpt === '1') {
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
          return parseInt(data[args[4]]) === checkValue ? true : false;
        }
      );
      args[5].draw();
      $.fn.dataTable.ext.search.pop();
    } else if (attackOpt === '2') {
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
          return parseInt(data[args[4]]) >= checkValue ? true : false;
        }
      );
      args[5].draw();
      $.fn.dataTable.ext.search.pop();
    } else if (attackOpt === '3') {
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
          return parseInt(data[args[4]]) <= checkValue ? true : false;
        }
      );
      args[5].draw();
      $.fn.dataTable.ext.search.pop();
    } else if (attackOpt === '4') {
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
          return parseInt(data[args[4]]) > checkValue ? true : false;
        }
      );
      args[5].draw();
      $.fn.dataTable.ext.search.pop();
    } else if (attackOpt === '5') {
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
          return parseInt(data[args[4]]) < checkValue ? true : false;
        }
      );
      args[5].draw();
      $.fn.dataTable.ext.search.pop();
    } else {
      const maxValue = parseInt($(args[2]).val());
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
          return parseInt(data[args[4]]) >= checkValue && parseInt(data[args[4]]) <= maxValue ? true : false;
        }
      );
      args[5].draw();
      $.fn.dataTable.ext.search.pop();
    }
  }
  function multiSearch(table, columns, text) {
    if (text !== '') {
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
          if ((data[columns[0]] && data[columns[0]].includes(text)) || (data[columns[1]] && data[columns[1]].includes(text))) return true;
          return false;
        }
      );
    }
    table.draw();
    $.fn.dataTable.ext.search.pop();
  }
  