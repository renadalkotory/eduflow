function playLesson(videoUrl, title, duration)
{
    // Convert YouTube URL
    let videoId = getYouTubeId(videoUrl);

    if (videoId) {

        document.getElementById('courseVideo').src =
            'https://www.youtube.com/embed/' + videoId;

    }

    // Update lesson title
    document.getElementById('lessonTitle').innerText = title;

    // Update duration
    document.getElementById('lessonDuration').innerText =
        'Duration: ' + duration;
}


function getYouTubeId(url)
{
    let regExp =
        /(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&?/]+)/;

    let match = url.match(regExp);

    return match ? match[1] : null;
}
