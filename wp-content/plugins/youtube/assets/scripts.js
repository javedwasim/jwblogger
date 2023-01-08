var dbfy_download_in_action = false;
function dbfy_download(event_, id)
{
	event_.preventDefault();
	if (dbfy_download_in_action){
		alert("Another download in action, please wait");
		return;
	}
	dbfy_download_in_action=true;
	
	let area= event_.target.parentNode.querySelector(".downloadButtons");
	let classN = " shown";
	if (area.className.indexOf(classN) >= 0 )
	{
		area.className= area.className.replace(classN,''); 
		return;
	}
	area.className = area.className + classN; 
	let url = location.href;
	let params = { "dbfy_download": id }; 
	area.innerHTML =  "Loading ...";

	return fetch(url, {
		method: "post",
		body:JSON.stringify(params)
	}).then(function(response) {
		return response.text().then(function(text) {
			dbfy_download_in_action = false;
			let content = '';
			try {
				let continue_=false;
				let obj = null;
				try{
					obj = JSON.parse(text);
					continue_ = true;
				} catch (e) {
					content = "Website can not return response. Try again or contact admin:<br/>"+ text;
				}
				if (continue_)
				{
					if ( "status" in obj )
					{
						if ( obj.status =="success" )
						{
							try
							{
								content += '<div class="container1">';
								//
								let videos = obj.data['videos'];
								let audios = obj.data['audios'];
								audioss = audios;
								
								// VIDEO
								content += `<div class="videos">
												<span class="title">Video:</span>`;
								let videoSortedByCapacity = videos.sort(function(a, b) { return b.contentLength - a.contentLength; });
								for (var key in videoSortedByCapacity)
								{
									let obj = videos[key];
									content += 
									`<span class="prop url"><a href="${obj.url}" target="_blank">Download</a></span>
									( <span class="prop mimeType">`+(obj.mimeType.split(";")[0]).replace("video/","")+`</span> <span class="prop qualityLabel">${obj.qualityLabel}</span> 
									  | <span class="prop contentLength">`+Math.floor(parseInt(obj.contentLength)/(1024*1024)) +` MB</span> 
									  | <span class="prop audioQuality">audio: `+ obj.audioQuality.replace("AUDIO_QUALITY_","").toLowerCase() +`</span> 
									)`;
								}
								content += '</div>';
								// AUDIO
								content += `<div class="audios">
											<span class="title">Audio:</span>`;
								let audiosSortedByCapacity = audios.sort(function(a, b) { return b.contentLength - a.contentLength; });
								for (var key in audiosSortedByCapacity)
								{
									let obj = audios[key];
									content += 
									`<div class="eachRow">
										<span class="url"><a href="${obj.url}" target="_blank">Download</a></span>
										(
										 <span class="prop mimeType">`+(obj.mimeType.split(";")[0]).replace("audio/","")+`</span>
										 <span class="prop contentLength">`+ Math.floor(parseInt(obj.contentLength)/(1024*1024)) +` MB</span>
										 <span class="prop qualityLabel">`+ obj.audioQuality.replace("AUDIO_QUALITY_","").toLowerCase() +`</span>
										)
									</div>`;
								}
								content += '</div>';
								
								let warningMsg = '<span class="yt_terms_comply">[ You are about to download the resource from YouTube. This website\'s owner(s) permitted to display download-buttons this video, however you still should be sure in they have a right and your compliance with <a href="https://www.youtube.com/static?template=terms" target="_blank">Youtube Terms & Services</a>, including principles about <a href="https://www.youtube.com/howyoutubeworks/policies/copyright/#fair-use" target="_blank">Fair Use</a>. If unsure, refraing from downloading. ]</span>';
								// container1
								content += warningMsg;
								content += '</div>';
							} catch (e) {
								content = "Site has problems. Contact admin."+ e.message;
							}
						}
						else{
							content = obj.data;
						}
					}
				}
			} catch (e) {
				content = "Website can not return response. Try again or contact admin:<br/>"+ e.message;
			}
			area.innerHTML = content;
		});
	});
}
 