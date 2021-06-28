const Discord = require('discord.js');
const client = new Discord.Client();
client.login("ODU5MDAyMjIzOTc4MzQ4NTQ0.YNmWKQ.CahWS3Wwt_o6sHvlsrV2CrHSzYA");
client.login("https://cbh-hosting.herokuapp.com/");
client.on('ready', function () {
    console.log("cbh-hosting");
});

client.on("message", function(msg) {
    if(msg.channel.id == "859077598717018183" && msg.content === '/server') {
        msg.reply('https://kotak-craft.herokuapp.com');
    }
});
client.on("message", function(msg) {
    if(msg.channel.id == "859077598717018183" && msg.content === '/dashboard') {
        msg.reply('https://c4a58e04ae0e.ngrok.io/');
    }
});
client.on("message", function(msg) {
    if(msg.channel.id == "859077598717018183" && msg.content === '/join') {
        msg.reply('Join server minecraft: kotak-craft.mcalias.com');
    }
});