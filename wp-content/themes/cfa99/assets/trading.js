var COLOR_PURPLE = '#B64FF5',
  COLOR_YELLOW = '#FEC703',
  COLOR_BLUE_ACCESS = '#48C1CC',
  COLOR_GREEN = '#60B523',
  COLOR_RED = '#E63124';
var RESULT_PRICE = {};
var codeStock = "FPT",
  infoExtra = [];
var $select = {};
var $select_2 = {};
async function callApi(endPoint, method, isToken = true, body, isJson = false, token) {
  var myHeaders = new Headers();
  var requestOptions = {
    method: method,
    redirect: 'follow',
  };
  if (isToken) {
    myHeaders.append(
      'Authorization',
      'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6IkdYdExONzViZlZQakdvNERWdjV4QkRITHpnSSIsImtpZCI6IkdYdExONzViZlZQakdvNERWdjV4QkRITHpnSSJ9.eyJpc3MiOiJodHRwczovL2FjY291bnRzLmZpcmVhbnQudm4iLCJhdWQiOiJodHRwczovL2FjY291bnRzLmZpcmVhbnQudm4vcmVzb3VyY2VzIiwiZXhwIjoxODg5NjIyNTMwLCJuYmYiOjE1ODk2MjI1MzAsImNsaWVudF9pZCI6ImZpcmVhbnQudHJhZGVzdGF0aW9uIiwic2NvcGUiOlsiYWNhZGVteS1yZWFkIiwiYWNhZGVteS13cml0ZSIsImFjY291bnRzLXJlYWQiLCJhY2NvdW50cy13cml0ZSIsImJsb2ctcmVhZCIsImNvbXBhbmllcy1yZWFkIiwiZmluYW5jZS1yZWFkIiwiaW5kaXZpZHVhbHMtcmVhZCIsImludmVzdG9wZWRpYS1yZWFkIiwib3JkZXJzLXJlYWQiLCJvcmRlcnMtd3JpdGUiLCJwb3N0cy1yZWFkIiwicG9zdHMtd3JpdGUiLCJzZWFyY2giLCJzeW1ib2xzLXJlYWQiLCJ1c2VyLWRhdGEtcmVhZCIsInVzZXItZGF0YS13cml0ZSIsInVzZXJzLXJlYWQiXSwianRpIjoiMjYxYTZhYWQ2MTQ5Njk1ZmJiYzcwODM5MjM0Njc1NWQifQ.dA5-HVzWv-BRfEiAd24uNBiBxASO-PAyWeWESovZm_hj4aXMAZA1-bWNZeXt88dqogo18AwpDQ-h6gefLPdZSFrG5umC1dVWaeYvUnGm62g4XS29fj6p01dhKNNqrsu5KrhnhdnKYVv9VdmbmqDfWR8wDgglk5cJFqalzq6dJWJInFQEPmUs9BW_Zs8tQDn-i5r4tYq2U8vCdqptXoM7YgPllXaPVDeccC9QNu2Xlp9WUvoROzoQXg25lFub1IYkTrM66gJ6t9fJRZToewCt495WNEOQFa_rwLCZ1QwzvL0iYkONHS_jZ0BOhBCdW9dWSawD6iF1SIQaFROvMDH1rg'
    );
    requestOptions.headers = myHeaders;
  }
  if(token){
    myHeaders.append(
      'Authorization',
      'Bearer '+ token
    );
    requestOptions.headers = myHeaders;
  }
  if (isJson) {
    myHeaders.append('Content-Type', 'application/json');
    requestOptions.headers = myHeaders;
  }
  if (body) requestOptions.body = JSON.stringify(body);

  return fetch(endPoint, requestOptions)
    .then((response) => response.text())
    .then((result) => JSON.parse(result))
    .catch((error) => console.log('error', error));
  // return response
}

function formatnumber(number, fixed = 2) {
  if (isNaN(number) || !number) return 0;
  number = number.toFixed(fixed);
  return new Intl.NumberFormat().format(number);
}
async function getHistories() {
  var endpoint =
    'https://trading.greenstock.vn/data/api/realtime/intradayticker';
  var resultHistories = await callApi(
    endpoint,
    'POST',
    false,
    {
      ticker: codeStock,
    },
    true
  );
  resultHistories = resultHistories?.data;
  var html = '';
  var dataChart = [];
  for (let i = 0; i < resultHistories.length; i++) {
    if (i > 500) break;
    let item = resultHistories[i];
    html +=
      '<tr>' +
      '<td>' +
      item.time +
      '</td>' +
      "<td><b style='color: " +
      checkDisplayColor(item.price) +
      "'>" +
      item.price +
      '</b></td>' +
      '<td>' +
      formatnumber(item?.volume) +
      '</td>' +
      '</tr>';
    if (i > 10) continue;
  }

  jQuery('#historiesPrice').html(html);
}

async function getInfoCommon(notShowExtra) {
  var fundalmental =
    'https://restv2.fireant.vn/symbols/' + codeStock + '/fundamental';
  var priceUrl =
    'https://price.vfs.com.vn/rest/market/api/getQuotesBySecCode?secCode=' +
    codeStock;
  var resultFundalmental = await callApi(fundalmental, 'GET', true);
  var resultPrice = await callApi(priceUrl, 'GET', false);
  resultPrice = resultPrice?.data;
  RESULT_PRICE = resultPrice;
  let indexStock =  ['HNX30', 'HNXINDEX', 'UPINDEX', 'VN30', 'VNINDEX'];
  let isIndexStock = indexStock.findIndex(e => e === codeStock)
  var dataTable = [
    {
      color: checkDisplayColor(resultPrice?.basicPrice),
      value: formatnumber(resultPrice?.basicPrice),
      alias: 'Tham chiếu',
      isShow: true
    },
    {
      color: checkDisplayColor(resultPrice?.openPrice),
      value: formatnumber(resultPrice?.openPrice),
      alias: 'Mở cửa',
      isShow: true
    },
    {
      color: '',
      isSpecial: true,
      value:
        '<div class="pr-1 text-right"><span style="color:' +
        checkDisplayColor(resultPrice?.lowestPrice) +
        '">' +
        formatnumber(resultPrice?.lowestPrice) +
        '</span> - <span style="color:' +
        checkDisplayColor(resultPrice?.highestPrice) +
        '">' +
        formatnumber(resultPrice?.highestPrice) +
        '</span></div>',
      alias: 'Thấp - cao',
      isShow: true
    },
    {
      color: '',
      value: formatnumber(resultPrice?.totalQty),
      alias: 'Khối Lượng',
      isShow: isIndexStock < 0
    },
    {
      color: '',
      value:
        formatnumber(
          resultPrice?.totalAmt ? resultPrice?.totalAmt / 1000000 : 0
        ) + ' tỷ',
      alias: 'Giá trị',
      isShow: isIndexStock < 0
    },
    {
      color: '',
      value: formatnumber(resultFundalmental?.avgVolume10d),
      alias: 'KLTB 10 ngày',
      isShow: isIndexStock < 0
    },
    {
      color: '',
      value: formatnumber(resultFundalmental?.beta),
      alias: 'Beta',
      isShow: isIndexStock < 0
    },
    {
      color: '',
      value:
        formatnumber(
          resultFundalmental?.marketCap
            ? resultFundalmental.marketCap / 1000000000
            : 0
        ) + ' tỷ',
      alias: 'Thị giá vốn',
      isShow: isIndexStock < 0
    },
    {
      color: '',
      value: formatnumber(resultFundalmental?.sharesOutstanding),
      alias: 'Số lượng CPLH',
      isShow: isIndexStock < 0
    },
    {
      color: '',
      value: formatnumber(resultFundalmental?.pe),
      alias: 'P/E',
      isShow: isIndexStock < 0
    },
    {
      color: '',
      value: formatnumber(resultFundalmental?.eps, 0),
      alias: 'EPS',
      isShow: isIndexStock < 0
    },
    {
      color: '',
      value: formatnumber(resultPrice?.totalQty?? 0),
      alias: 'Tổng KL',
      isShow: isIndexStock > 0
    },
  ];
  var html = '';
  if(!notShowExtra){
    infoExtra.map((e, index) => {
      var id = index + 1;
      var textFull = e.value;
      var textCuted = e.value;
      if (e.value?.length > 130) {
        textCuted = textCuted.slice(0, 130) + '...';
      } else {
        textCuted = e.value;
      }

      if (e.color) {
        html +=
          '<div class="d-flex py-1"><span class="pl-1 text-dark">' +
          e.label +
          ' :</span>';
        html +=
          '<b class="text-right" id="label_' +
          id +
          '" style="color:' +
          e.color +
          ';flex: 1 1 auto" title="' +
          textFull +
          '">' +
          textCuted +
          '</b>';
      } else {
        html += '<div class="py-1"><b class="pl-2">' + e.label + ' :</b>';
        html +=
          '<span class="text-right" id="label_' +
          id +
          '" title="' +
          textFull +
          '">' +
          textCuted +
          '</span>';
      }
      if (e.value.length > 130) {
        html +=
          '<span class="text-info border-bottom" id= "text_' +
          id +
          '" data-show="0" data-text="' +
          textFull +
          '" onclick="showMore(' +
          id +
          ')"> xem thêm</span>';
      }
      html += '</div>';
    });
  }
  html +=  '<div class="d-flex py-1"><span class="pl-1 text-dark">'
  html += resultPrice.avgPrice
  html += ' :</span>';
  html += ' <span>';
  html += (resultPrice.avgPrice /resultPrice?.basicPrice) * 100
  html += ' </span>';
  html += '</div>'

console.log(1111)
  html += '<table class="table table-striped">';

  dataTable.map((e) => {
    var th = () => {
      if (e?.isSpecial) return '<th>' + e?.value + '</th>';
      return (
        '<th> <div class="text-right pr-1" style=" color:' +
        e?.color +
        '">' +
        e?.value +
        '</div></th>'
      );
    };
    html += e.isShow ?
      '<tr>' +
      '<td style="width:75%"> <div class="pl-1">' +
      e.alias +
      '</td>' +
      th() +
      '</tr>' : '';
  });
  html += '</table>';

  jQuery('.nav-home-content').html(html);
  // dùng trường best1BidPriceStr , best1OfferPriceStr để check màu sắc và hiển thị giá mua bán dòng đầu, nếu = ATO || ATC thì màu đen,
  var dataSell = [
    {
      label: 'bestOffer',
      price: resultPrice?.best1OfferPriceStr,
      qty: resultPrice?.best1OfferQty,
      color: checkDisplayColor(resultPrice?.best1OfferPrice),
      bgColor: '',
    },
    {
      label: 'bestOffer',
      price: resultPrice?.best2OfferPrice,
      qty: resultPrice?.best2OfferQty,
      color: checkDisplayColor(resultPrice?.best2OfferPrice),
      bgColor: '',
    },
    {
      label: 'bestOffer',
      price: resultPrice?.best3OfferPrice,
      qty: resultPrice?.best3OfferQty,
      color: checkDisplayColor(resultPrice?.best3OfferPrice),
      bgColor: '',
    },
  ];
  var dataBuy = [
    {
      label: 'bestOffer',
      price: resultPrice?.best1BidPriceStr,
      qty: resultPrice?.best1BidQty,
      color: checkDisplayColor(resultPrice?.best1BidPrice),
      bgColor: '',
    },
    {
      label: 'bestOffer',
      price: resultPrice?.best2BidPrice,
      qty: resultPrice?.best2BidQty,
      color: checkDisplayColor(resultPrice?.best2BidPrice),
      bgColor: '',
    },
    {
      label: 'bestOffer',
      price: resultPrice?.best3BidPrice,
      qty: resultPrice?.best3BidQty,
      color: checkDisplayColor(resultPrice?.best3BidPrice),
      bgColor: '',
    },
  ];

  let htmlSell = '';
  let maxWidthSell = total(dataSell);
  dataSell.map((e) => {
    htmlSell +=
      '<div class="sc-lgpMPf bthUPl"><div class="sc-hECAmk bCzOtC" style="padding-left: 4px; font-weight: bold;"><span style="padding: 4px; color: ' +
      e.color +
      ';">' +
      e.price +
      '&nbsp;</span></div><div class="sc-ldxQMJ dacVUY" style="justify-content: flex-end;"><span style="padding: 4px;">' +
      formatnumber(e.qty) +
      '&nbsp;</span></div><div style="position: absolute; z-index: 0; top: 0px; bottom: 0px; left: 2px; width:' +
      (e.qty / maxWidthSell) * 100 +
      '%; background-color:' +
      checkDisplayColor(e.price) +
      ';opacity:0.5"></div></div>';
  });
  let htmlBuy = '';
  let maxWidthBuy = total(dataBuy);
  dataBuy.map((e) => {
    htmlBuy +=
      '<div class="sc-lgpMPf bthUPl"><div class="sc-ldxQMJ dacVUY"><span style="padding: 4px;">&nbsp;' +
      formatnumber(e.qty) +
      '</span></div><div class="sc-hECAmk bCzOtC" style="justify-content: flex-end;padding-right: 4px;font-weight: bold;"><span style="padding: 4px; color: ' +
      checkDisplayColor(e.price) +
      ';">&nbsp;' +
      e.price +
      '</span></div><div style="position: absolute;z-index: 0;top: 0px;bottom: 0px;right: 2px;width: ' +
      (e.qty / maxWidthBuy) * 100 +
      '%;background-color: ' +
      checkDisplayColor(e.price) +
      ';opacity:0.5"></div></div>';
  });

  jQuery('.totalQty').text(formatnumber(resultPrice?.totalQty?? 0));
  jQuery('.widgetSellStock').html(htmlSell);
  jQuery('.widgetBuyStock').html(htmlBuy);
}

function checkDisplayColor(price = 0) {
  return checkColor(
    price,
    RESULT_PRICE?.ceilingPrice,
    RESULT_PRICE?.floorPrice,
    RESULT_PRICE?.basicPrice
  );
}

jQuery('.item-code-btn').click(async function () {
  codeStock = jQuery(this).attr('data-code');
  infoExtra = jQuery(this).attr('data-value');
  infoExtra = JSON.parse(infoExtra);
  await changeStock();
  await setData(codeStock,codeStock);
});

async function changeStock(notShowExtra) {
  jQuery('#sidebar-chart iframe').attr(
    'src',
    'https://info.sbsi.vn/chart/?symbol=' +
      codeStock +
      '&language=vi&theme=light'
  );
  await getInfoCommon(notShowExtra);
}
function handle() {
  //then set up some access points
  var contents = jQuery(this).contents(); // contents of the iframe
  jQuery(contents)
    .find('body')
    .on('click', function (event) {
      alert('test');
    });
}

function total(array) {
  var total = 0;
  array.map((e) => {
    total += e.qty;
  });
  return total;
}

async function chartPrice() {
  var endpoint =
    ' https://trading.greenstock.vn/data/api/realtime/intradaytickerbyprice';
  var resultChart = await callApi(
    endpoint,
    'POST',
    false,
    {
      ticker: codeStock,
    },
    true
  );
  resultChart = resultChart?.data;
  var dataChart = [];
  resultChart.map((item) => {
    dataChart.push({
      y: item.volume / 1000,
      label: formatnumber(item?.price),
      indexLabel: formatnumber(item?.price),
      color: checkDisplayColor(item?.price),
    });
  });
  //Better to construct options first and then pass it as a parameter
  var options = {
    animationEnabled: true,
    backgroundColor: '#f4f6f9',
    height: 700,
    dataPointMaxWidth: 40,
    axisY: {
      tickThickness: 1,
      lineThickness: 1,
      includeZero: true,
      gridThickness: 1,
      gridColor: '#bbb',
      gridDashType: 'dash',
    },
    axisX: {
      gridDashType: 'dash',
      gridColor: '#bbb',
      tickThickness: 1,
      includeZero: true,
      lineThickness: 1,
      labelFontSize: 14,
      labelFontColor: '#000',
    },
    toolTip: {
      borderColor: '#000000c7',
      backgroundColor: '#000000c7',
      fontColor: '#fff',
    },
    data: [
      {
        indexLabelFontSize: 10,
        toolTipContent:
          '<span>Mức giá :{indexLabel}</span> <br> <span>Tổng KL: <strong>{y}</strong></span>',
        indexLabelPlacement: '',
        indexLabelFontColor: '#ffffff00',
        indexLabelFontWeight: 100,
        type: 'bar',
        dataPoints: dataChart,
      },
    ],
  };

  jQuery('#chartContainer').CanvasJSChart(options);
}

async function statistical() {
  var currentDate = new Date();

  var startDate = subtractMonths(new Date(), 1);
  var endPoint =
    'https://restv2.fireant.vn/symbols/' +
    codeStock +
    '/historical-quotes?startDate=' +
    formatDate(startDate) +
    '&endDate=' +
    formatDate(currentDate) +
    '&offset=0&limit=10';
  var result = await callApi(endPoint, 'GET', true, null, false);
  var dataChart = [],
    htmlVolume = '',
    htmlPrice = '';
  const totalColor = (total) => {
    if (total == 0) return '#000';
    if (total > 0) return COLOR_GREEN;
    if (total < 0) return COLOR_RED;
  };

  for (let i = 0; i < result.length; i++) {
    let item = result[i];

    if (i === 0) {
      console.log(item?.buyForeignQuantity);
      htmlVolume +=
        '<tr>' +
        "<td> <b class='pl-2' style='color:" +
        COLOR_GREEN +
        "'>" +
        formatnumber(item?.buyForeignQuantity) +
        '<b></td>' +
        "<td> <b class='pl-2' style='color:" +
        COLOR_RED +
        "'>" +
        formatnumber(item?.sellForeignQuantity) +
        '</b></td>' +
        "<td> <b class='pl-2' style='color:" +
        totalColor(item?.buyForeignQuantity - item?.sellForeignQuantity) +
        "'>" +
        formatnumber(item?.buyForeignQuantity - item?.sellForeignQuantity) +
        ' </b></td></tr>';

      htmlPrice +=
        '<tr>' +
        "<td> <b class='pl-2' style='color:" +
        COLOR_GREEN +
        "'>" +
        formatnumber(item?.buyForeignValue / 1000000000) +
        ' tỷ </b></td>' +
        "<td> <b class='pl-2' style='color:" +
        COLOR_RED +
        "'>" +
        formatnumber(item?.sellForeignValue / 1000000000) +
        ' tỷ</b></td>' +
        "<td> <b class='pl-2' style='color:" +
        totalColor(item?.buyForeignValue - item?.sellForeignValue) +
        "'>" +
        formatnumber(
          (item?.buyForeignValue - item?.sellForeignValue) / 1000000000
        ) +
        ' tỷ</b></td></tr>';
    }
    let date = new Date(item.date);
    var dataY = (item?.buyForeignValue - item?.sellForeignValue) / 1000000000;
    dataChart.push({
      label:
        item?.buyForeignValue - item?.sellForeignValue
          ? formatMoth(date)
          : '  ',
      y: Number.parseFloat(dataY.toFixed(2)),
      color: totalColor(item?.buyForeignValue - item?.sellForeignValue),
    });
  }

  var options = {
    backgroundColor: '#f4f6f9',
    axisY: {
      tickThickness: -1,
      lineThickness: 0,
      includeZero: true,
      gridThickness: 1,
      gridColor: '#bbb',
      gridDashType: 'dash',
    },
    toolTip: {
      content:
        '<span>Ngày mua: {label} </span><br><span> Giá trị mua dòng: {y}</span>',
      borderColor: '#000000c7',
      backgroundColor: '#000000c7',
      fontColor: '#fff',
    },

    data: [
      {
        // Change type to "doughnut", "line", "splineArea", etc.
        type: 'column',
        dataPoints: dataChart.reverse(),
      },
    ],
  };
  jQuery('.htmlVolume').html(htmlVolume);
  jQuery('.htmlVolume-2').html(htmlVolume);

  jQuery('.htmlPrice').html(htmlPrice);
  jQuery('.htmlPrice-2').html(htmlPrice);

  jQuery('.chart-statistical').CanvasJSChart(options);
  jQuery('.chart-statistical-2').CanvasJSChart(options);

}

function subtractMonths(date, months) {
  date.setMonth(date.getMonth() - months);

  return date;
}

function formatDate(date = new Date()) {
  const year = date.toLocaleString('default', {
    year: 'numeric',
  });
  const month = date.toLocaleString('default', {
    month: '2-digit',
  });
  const day = date.toLocaleString('default', {
    day: '2-digit',
  });

  return [year, month, day].join('-');
}

function showMore(id) {
  let idCurrent = jQuery('#label_' + id);
  let idSpan = jQuery('#text_' + id);

  let dataShow = idSpan.attr('data-show');
  var textFull = idCurrent.attr('title');
  if (dataShow == '0') {
    idCurrent.text(textFull);
    idSpan.attr('data-show', '1');
    idSpan.text('ẩn bớt');
  }

  if (dataShow == '1') {
    var textCuted = textFull.slice(0, 130);
    idCurrent.text(textCuted + '...');
    idSpan.attr('data-show', '0');
    idSpan.text('Xem thêm');
  }
}

function formatMoth(date = new Date()) {
  const month = date.toLocaleString('default', {
    month: '2-digit',
  });
  const day = date.toLocaleString('default', {
    day: '2-digit',
  });

  return [day, month].join('/');
}

function checkColor(
  lastPrice = 0,
  ceilingPrice = 0,
  floorPrice = 0,
  basicPrice = 0
) {
  if (
    lastPrice >=
    ceilingPrice /*Nếu: LAST_PRICE >= giá trần thì hiển thị màu tím*/
  )
    return COLOR_PURPLE;
  if (
    lastPrice <= floorPrice /*Nếu: LAST_PRICE <= giá sàn => màu xanh da trời*/
  )
    return COLOR_BLUE_ACCESS;
  if (lastPrice == basicPrice /*Nếu: LAST_PRICE = giá tham chiếu => màu vàng*/)
    return COLOR_YELLOW;
  if (
    basicPrice < lastPrice &&
    lastPrice <
      ceilingPrice /*Nếu: giá tham chiếu <  LAST_PRICE < giá trần => màu xanh lá cây*/
  )
    return COLOR_GREEN;
  if (
    floorPrice < lastPrice &&
    lastPrice <
      basicPrice /*Nếu: giá sàn < LAST_PRICE < giá tham chiếu => màu đỏ*/
  )
    return COLOR_RED;
  return COLOR_PURPLE;
}

jQuery(document).ready(async function () {
  console.log(111);
  $select = await jQuery('.normalize').selectize({
    create: false,
    onDropdownOpen: function () {
      jQuery('.custom-listStock').css('width', '85%');
      jQuery('.selectize-dropdown').css('width', '100%');
    },
    valueField: 'id',
    labelField: 'id',
    searchField: 'id',
    onDropdownClose: function () {
      jQuery('.custom-listStock').css('width', '10.5%');
    },
    onType: async function (text) {
      if(!text) return false;
      await setData(text)
    },
    onChange: async function (e) {
      if(!e) return setData('a')
      codeStock = await e;
      await changeStock(false)
      await statistical()
      await getHistories()
      await chartPrice()
      checkIndexStock(e)


    },
    onDelete: async function() {
     await setData('a')
    },
    render: {
      option: function(item){
      }
    }
  });
  $select_2 = await jQuery('.normalize-2').selectize({
    create: false,
    onDropdownOpen: function () {
      jQuery('.custom-listStock-2').css('width', '85%');
      jQuery('.selectize-dropdown').css('width', '100%');
    },
    valueField: 'id',
    labelField: 'id',
    searchField: 'id',
    onDropdownClose: function () {
      jQuery('.custom-listStock-2').css('width', '25.5%');
    },
    onType: async function (text) {
      if(!text) return false;
      await setData(text)
    },
    onChange: async function (e) {
      if(!e) return setData('a')
      codeStock = await e;
      await changeStock(true)
      await statistical()
      await getHistories()
      await chartPrice()
      checkIndexStock(e)


    },
    onDelete: async function() {
    //  await setData('a')
    },
    render: {
      option: function(item){
       return ("<div class='d-flex' > <div class='p-2 ' style='flex: 1 1 auto'>"+item.id+"</div><div class='p-2 '> "+item.title+"</div></div>")
      }
    }
  });
  if(IS_SINGLE){
    await setData(codeStock, codeStock);
    await changeStock()
    await statistical()
    await getHistories()
    await chartPrice()
  }else{
    await setData();
  }

});
function formatState(state) {
  if (!state.id) {
    return state.text;
  }
  var $state = jQuery(
    '<div class="row" style=""> <div class="col-3">' +
      state.id +
      '</div> <div class="col-9">' +
      state.text +
      '</div></div>'
  );
  return $state;
}

async function  setData(text, defaults) {
  if(!text){
    text= codeStock
  }
  let token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6IkdYdExONzViZlZQakdvNERWdjV4QkRITHpnSSIsImtpZCI6IkdYdExONzViZlZQakdvNERWdjV4QkRITHpnSSJ9.eyJpc3MiOiJodHRwczovL2FjY291bnRzLmZpcmVhbnQudm4iLCJhdWQiOiJodHRwczovL2FjY291bnRzLmZpcmVhbnQudm4vcmVzb3VyY2VzIiwiZXhwIjoxODg5NjIyNTMwLCJuYmYiOjE1ODk2MjI1MzAsImNsaWVudF9pZCI6ImZpcmVhbnQudHJhZGVzdGF0aW9uIiwic2NvcGUiOlsiYWNhZGVteS1yZWFkIiwiYWNhZGVteS13cml0ZSIsImFjY291bnRzLXJlYWQiLCJhY2NvdW50cy13cml0ZSIsImJsb2ctcmVhZCIsImNvbXBhbmllcy1yZWFkIiwiZmluYW5jZS1yZWFkIiwiaW5kaXZpZHVhbHMtcmVhZCIsImludmVzdG9wZWRpYS1yZWFkIiwib3JkZXJzLXJlYWQiLCJvcmRlcnMtd3JpdGUiLCJwb3N0cy1yZWFkIiwicG9zdHMtd3JpdGUiLCJzZWFyY2giLCJzeW1ib2xzLXJlYWQiLCJ1c2VyLWRhdGEtcmVhZCIsInVzZXItZGF0YS13cml0ZSIsInVzZXJzLXJlYWQiXSwianRpIjoiMjYxYTZhYWQ2MTQ5Njk1ZmJiYzcwODM5MjM0Njc1NWQifQ.dA5-HVzWv-BRfEiAd24uNBiBxASO-PAyWeWESovZm_hj4aXMAZA1-bWNZeXt88dqogo18AwpDQ-h6gefLPdZSFrG5umC1dVWaeYvUnGm62g4XS29fj6p01dhKNNqrsu5KrhnhdnKYVv9VdmbmqDfWR8wDgglk5cJFqalzq6dJWJInFQEPmUs9BW_Zs8tQDn-i5r4tYq2U8vCdqptXoM7YgPllXaPVDeccC9QNu2Xlp9WUvoROzoQXg25lFub1IYkTrM66gJ6t9fJRZToewCt495WNEOQFa_rwLCZ1QwzvL0iYkONHS_jZ0BOhBCdW9dWSawD6iF1SIQaFROvMDH1rg'
  let listCost = await callApi('https://restv2.fireant.vn/search?keywords='+text+'&type=symbol&offset=0&limit=200','GET',false,false,false, token);
  let selectize = $select[0].selectize
  let selectize2 = $select_2[0].selectize


  selectize.clearOptions();
  listCost.map(e =>{
    selectize.addOption({
      'id': e.key,
      'title': e.name
    })
  })

  selectize2.clearOptions();
  listCost.map(e =>{
    selectize2.addOption({
      'id': e.key,
      'title': e.name
    })
  })
  if(defaults){
    selectize2.setValue(selectize2.search(defaults).items[0].id);
    selectize.setValue(selectize.search(defaults).items[0].id);

  }
}

function checkIndexStock(stock){
  let indexStock =  ['HNX30', 'HNXINDEX', 'UPINDEX', 'VN30', 'VNINDEX'];
  if(!indexStock.find(e => e === stock)) {
    jQuery('.notIndexStock').css('display', 'block')
    jQuery('.index__stock').css('display', 'none')
    return false
  }
  jQuery('.notIndexStock').css('display', 'none')
  jQuery('.index__stock').css('display', 'block')
}
