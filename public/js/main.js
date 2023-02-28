// 選択肢増やすボタン
// document.getElementById("addOption").addEventListener('click', addOption);
const addOptionBtn = document.getElementById("addOption");
addOptionBtn.addEventListener('click', addOption);

let count = 2;

function addOption() {
    count++;
    let options = document.getElementById('options');
    let option = document.createElement('div');
    option.classList.add("option_iptxt");
    option.innerHTML = `        
        <input class="" type="text" name="option${count}" maxlength="20" placeholder="選択肢${count}" required>
      `
    options.appendChild(option);
    // document.getElementById("countVal").value = count;

    // 要素の数が6個になったら、ボタンを無効にする
    if (count >= 6) {
        addOptionBtn.disabled = true;
        addOptionBtn.classList.add("hidden");
    }
}



let tweetWrapp = document.getElementsByClassName('tweetWrapp');
for (let i = 1; i <= tweetWrapp.length; i++) {
    let countText = document.getElementsByClassName('count' + i);
    let radioBtn = document.getElementsByClassName('radioBtn' + i);
    let option = document.getElementsByClassName('option' + i);
    let selectBtn = document.getElementsByClassName('selectBtn' + i);

    let lastRadioBtnId = 0;
    let lastRadioBtnValue = 0;
    let lastRadioBtnFlag = 0;





    for (let j = 0; j < radioBtn.length; j++) {

        radioBtn[j].addEventListener('click', function () {

            if (lastRadioBtnFlag == 1) {
                // 直前に押されたラジオボタンの要素を-1する
                radioBtn[lastRadioBtnId].value--;
                console.log("radioBtn[" + lastRadioBtnId + "].valueを-1した値：" + radioBtn[lastRadioBtnId]
                    .value);
                countText[lastRadioBtnId].textContent = radioBtn[lastRadioBtnId].value;
                let lastRadioBtnFlag = 0;
            }

            if (radioBtn[j].checked) {
                // 直前に押されたラジオボタンの要素を保管
                lastRadioBtnId = j;
                lastRadioBtnValue = radioBtn[j].value;
                lastRadioBtnFlag = 1

                radioBtn[j].value++;
                console.log("radioBtn[" + j + "].value：" + radioBtn[j].value);



                fetch('Controllers/TweetController', {
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }, // CSRFトークン対策
                    body: JSON.stringify({
                        id: radioBtn[j].name, //tweet ID
                        name: option[j].textContent,
                        count: radioBtn[j].value,
                    }),
                })
                    .then(response => response.json())
                    .then(data => console.log(data))
                    .catch(error => console.error(error));


                // fetch SQL count up

                // const postData = new FormData; // フォーム方式で送る場
                // postData.set('name', option[j].textContent);   // set()で格納する
                // postData.set('count', radioBtn[j].value); // set()で格納する
                // console.log("ボタンvalue");
                // console.log(option[j].textContent);
                // console.log(radioBtn[j].value);
                // fetch('Controllers/TweetController', { // 第1引数に送り先
                //     method: 'POST', // メソッド指定
                //     headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }, // CSRFトークン対策
                //     body: postData
                // })
                //     // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
                //     // .then(response => response.json())
                //     .then(response => {
                //         // console.log(response.json());
                //         if (response.ok) {
                //             console.log('Update successful');
                //         } else {
                //             console.log('Update failed');
                //         }
                //     })
                //     .catch(error => {
                //         console.log(error); // エラー表示
                //     });


                // 割合計算
                // let totalCount = 0;

                // for (let k = 0; k < radioBtn.length; k++) {
                //     totalCount += Number(radioBtn[k].value);

                //     let countRatio = (Number(radioBtn[k].value) / totalCount) * 100;

                //     if (isFinite(countRatio) === false) {
                //         countRatio = 0;
                //     };

                //     console.log(countRatio);
                //     countText[k].textContent = countRatio + "%";

                //     // 割合に応じてグラフを変動
                //     selectBtn[k].style.cssText = 'width: ' + countRatio + '%; padding:0 10px 0 10px; justify-content: flex-start;';

                //     // radio button を一度のみ押せるようにする
                //     radioBtn[k].disabled = true;
                // }
                let totalCount = 0;
                for (let k = 0; k < radioBtn.length; k++) {
                    totalCount += Number(radioBtn[k].value);
                }

                
                

                for (let k = 0; k < radioBtn.length; k++) {
                    let countRatio = (Number(radioBtn[k].value) / totalCount) * 100;
                    if (isFinite(countRatio) === false) {
                        countRatio = 0;
                    }
                    countRatio = Math.floor(countRatio);
                    console.log(countRatio);
                    countText[k].textContent = countRatio + "%";
                    // 割合に応じてグラフを変動
                    selectBtn[k].style.cssText = 'width: ' + countRatio + '%; padding:0 10px 0 10px; justify-content: flex-start;';
                    // radio button を一度のみ押せるようにする
                    radioBtn[k].disabled = true;
                }


                console.log(totalCount);


                // 投票者数
                // const totalBox = document.getElementById("total");
                // var totalNum = document.createElement('p');
                // totalNum.textContent = totalCount + '投票';
                // // option.classList.add("option_iptxt");
                // totalBox.appendChild(totalNum);


            } else {

            }

        }
        )
    }
}





