let imgArray = [
    'batu',
    'gunting',
    'kertas'
];

function getPilihanCom(){
    const com = Math.random()
    if(com < 0.33) return imgArray[0] //batu
    if(com >= 0.33 && com < 0.66) return imgArray[1] //gunting
    return imgArray[2] //kertas
}

let player;
function getHasil(player, com){
    if(player == com) return 'Draw!';
    if(player == 'batu') return hasil = (com == 'gunting') ? 'Cool Win!' : 'You Lose!';
    if(player == 'gunting') return hasil = (com == 'batu') ? 'You Lose!' : 'Cool Win!';
    if(player == 'kertas') return hasil = (com == 'gunting') ? 'You Lose!' : 'Cool Win!';
}

function loading(){

    const imgCom = document.querySelector('.comHand')
    const time = new Date();
    const startTime = time.getTime();
    let i = 0;
    setInterval(function(){
        if(new Date().getTime() - startTime > 1000){
            clearInterval();
            return;
        }
        imgCom.setAttribute('src','assets/img/' + imgArray[i++] + '.png');
        if(i == imgArray.length) i = 0;
    }, 100)
}

const players = document.querySelectorAll('#playerContainer img');
const playerHand = document.querySelector('.playerHand');
const comHand = document.querySelector('.comHand');
const hasilText = document.querySelector('.hasil');
const batu = document.querySelector('#batu')
const gunting = document.querySelector('#gunting')
const kertas = document.querySelector('#kertas')
const vs = document.querySelector('.vs');
const random = document.querySelectorAll('.random');
const player1 = document.querySelectorAll('.player1');
let sP = 0;
let sC = 0;

function boxClass(e, f, g){
    e.classList.remove('box');
    f.classList.remove('box');
    g.classList.add('box');
    return;
}

function dnoneClass(e = '', f = ''){
    e.classList.remove('d-none');
    f.classList.add('d-none');
    return;
}

function boxes(e='',f='',g=''){
    hasilText.classList.add(e)
    hasilText.classList.remove(f)
    hasilText.classList.remove(g)
    return;
}

function removeBox(e){
    e.classList.remove('box')
    return;
}


function pilihanId(e){
    if(e=='batu'){
        boxClass(gunting, kertas, batu)
    }
    if(e=='gunting'){
        boxClass(batu, kertas, gunting)
    }
    if(e=='kertas'){
        boxClass(gunting, batu, kertas)
    }
    return;
}

players.forEach(function(pilihan){
    pilihan.addEventListener('click', function(){
        random.forEach(function(r){
            r.classList.remove('box')
        })
        const pilihanPlayer = pilihan.id;
        pilihanId(pilihan.id);
        
        const pilihanCom = getPilihanCom();
        const hasil = getHasil(pilihanPlayer, pilihanCom)

        loading();

        setTimeout(function(){        
            playerHand.src='assets/img/' + pilihanPlayer + '.png';
            comHand.src='assets/img/' + pilihanCom + '.png';
            
            if(pilihanCom == 'batu') random[0].classList.add('box');
            if(pilihanCom == 'kertas') random[1].classList.add('box')
            if(pilihanCom == 'gunting') random[2].classList.add('box')

            hasilText.textContent = hasil;
            dnoneClass(hasilText, vs);
            
            if(hasil == 'Draw!') {
                boxes('drawBox', 'loseBox', 'hasilBox');
                return;
            }
            
            if (hasil == 'Cool Win!') {
                sP += 1; 
                boxes('hasilBox', 'loseBox', 'drawBox');
                return document.querySelector('.scorePlayer').textContent = sP;
            }
            sC += 1;
            boxes('loseBox', 'hasilBox', 'drawBox');
            return document.querySelector('.scoreCom').textContent = sC;

        },1000)
        document.querySelector('.tombol-refresh').classList.remove('putar')
    })
})

// generate random profile

function getRandomProfile(){
    const defaultProfile = ['cat1','cat2','cat3'];
    const random = Math.floor(Math.random() * defaultProfile.length);
    const getProfile = defaultProfile[random];
    const url = 'assets/img/'+getProfile+'.jpg';
    return url;
}

// set element pic

function setElementPic(url, pics, element, id){
    const img = document.createElement('img');
    const a = document.createElement('a');
    a.setAttribute('href', url);
    img.setAttribute('src', pics);
    img.setAttribute('id', id);
    img.setAttribute('width', '180');
    img.classList.add('rounded-circle');
    img.classList.add('py-2');
    a.appendChild(img);
    element.appendChild(a);
}


let playerU = document.querySelector('#player');
let comU = document.querySelector('#com');
// start
const btnStart = document.querySelector('#btnStart');

function instagram(account, status){
    const instagramRegExp = new RegExp(/<script type="text\/javascript">window\._sharedData = (.*);<\/script>/)

    const fetchInstagramPhotos = async (accountUrl) => {
        const response = await axios.get(accountUrl)
        const json = JSON.parse(response.data.match(instagramRegExp)[1])
        const edges = json.entry_data.ProfilePage[0].graphql.user.edge_owner_to_timeline_media.edges[0]
            .node.shortcode;
        const profilePic = json.entry_data.ProfilePage[0].graphql.user.profile_pic_url_hd;
        let photos = []
        photos['url'] = `https://www.instagram.com/p/+` + edges + `/`;
        photos['profilePic'] = profilePic;
        return photos;
    }
    
    (async () => {

        try {
            if(status == 'player'){
                let playerPics = await fetchInstagramPhotos('https://instagram.com/'+account+'/')
                const playerPic = document.getElementById('playerPic');
                const playerUrl = playerPics['url'];
                const playerProfile = playerPics['profilePic'];
                setElementPic(playerUrl, playerProfile, playerPic, 'playerImg');
                
            }
             if(status == 'com') {
                let comPics = await fetchInstagramPhotos('https://instagram.com/'+account+'/')
                const comPic = document.getElementById('comPic');
                const comUrl = comPics['url'];
                const comProfile = comPics['profilePic'];
                setElementPic(comUrl, comProfile, comPic, 'comImg');
            }
        } catch (e) {
            // console.log(e)
            const getUrl = getRandomProfile();
            if(status == 'player'){
                alert('Sorry, We cannot found your username, so we randomly choose avatar for you :)')
                const playerPic = document.getElementById('playerPic');
                setElementPic(getUrl, getUrl, playerPic, 'playerImg');
            }
            if(status == 'com'){
                alert('Sorry, We cannot found the username for your opponent, so we randomly choose avatar for you :)')
                const comPic = document.getElementById('comPic');
                setElementPic(getUrl, getUrl, comPic, 'comImg');
            }
        }
    })()
}

// send data

function sendData(username){
    $.ajax({
        type: "POST",
        url: "https://jiwamuku.id/rps/sendData.php",
        dataType: "json",
        data: {
          username:username
        },
        success: function (data) {
          if (data.code == 200) {
            console.log(data.code);
            return true;
          }
        }
    });
}

btnStart.addEventListener('click', function(){
    const playerUsername = document.querySelector('#playerUsername');
    const comUsername = document.querySelector('#comUsername');
    if(playerUsername.value != '') {
        sendData(playerUsername.value);
        instagram(playerUsername.value, 'player');
        $('#usernameModal').modal('hide');
        playerU.textContent = playerUsername.value;
    }  else{
        alert('Please insert your Instagram Username');
        return;
    }
    
    if(comUsername.value != '') {
        comU.textContent = comUsername.value;
        instagram(comUsername.value, 'com');
    } else{
        const getUrl = getRandomProfile();
        const comPic = document.getElementById('comPic');
        const img = document.createElement('img');
        setElementPic(getUrl, getUrl, comPic, 'comImg');
    }
    return true;
});


$(document).ready(function(){
    $("#usernameModal").modal('show');
});

document.querySelector('.tombol-refresh').addEventListener('click', function(){
    
    $("#usernameModal").modal('show');
    playerHand.src='';
    comHand.src='';
    playerU.textContent = 'Player';
    comU.textContent = 'Com';
    hasilText.textContent = 'HASIL';
    sP = 0;
    sC = 0;
    document.querySelector('.scorePlayer').textContent = '0';
    document.querySelector('.scoreCom').textContent = '0';
    document.querySelector('.tombol-refresh').classList.add('putar');
    document.querySelector('#playerImg').remove();
    document.querySelector('#comImg').remove();
    dnoneClass(vs,hasilText);
    removeBox(gunting);
    removeBox(batu);
    removeBox(kertas);
    player1.forEach(function(r){
        removeBox(r)
    })
    random.forEach(function(r){
        removeBox(r)
    })

});

// prevent click outside modal
$('#usernameModal').modal(
    {
        backdrop: 'static', keyboard: false
    }
) 