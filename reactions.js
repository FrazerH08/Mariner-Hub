document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(e) {
        const reactBtn = e.target.closest('.react-btn');
        if (reactBtn) {
            handleReaction(reactBtn);
            return;
        }

        const reportBtn = e.target.closest('.report-btn');
        if (reportBtn) {
            handleReport(reportBtn);
            return;
        }

        const replyToggleBtn = e.target.closest('.reply-toggle-btn');
        if (replyToggleBtn) {
            const form = document.getElementById(replyToggleBtn.dataset.target);
            if (form) {
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            }
            return;
        }
    });
});

function handleReaction(btn) {
    const wrapper = btn.closest('.reactions');
    const contentType = btn.dataset.contentType;
    const contentId = btn.dataset.contentId;
    const type = btn.dataset.type;

    fetch('react.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'content_type=' + encodeURIComponent(contentType) +
                '&content_id=' + encodeURIComponent(contentId) +
                '&type=' + encodeURIComponent(type)
        })
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            wrapper.querySelector('.like-count').textContent = data.likes;
            wrapper.querySelector('.dislike-count').textContent = data.dislikes;
            wrapper.querySelector('.like-btn').classList.toggle('active', data.my_vote === 'like');
            wrapper.querySelector('.dislike-btn').classList.toggle('active', data.my_vote === 'dislike');
        })
        .catch(err => console.error('Reaction failed:', err));
}

function handleReport(btn) {
    if (!confirm('Report this comment for review?')) return;

    const contentType = btn.dataset.contentType;
    const contentId = btn.dataset.contentId;

    fetch('report.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'content_type=' + encodeURIComponent(contentType) +
                '&content_id=' + encodeURIComponent(contentId)
        })
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            btn.textContent = 'Reported';
            btn.disabled = true;

            if (data.hidden) {
                const commentBox = btn.closest('.comment-box');
                if (commentBox) {
                    commentBox.style.opacity = '0.5';
                    const notice = document.createElement('p');
                    notice.textContent = 'This comment has been hidden pending review.';
                    notice.style.fontStyle = 'italic';
                    commentBox.appendChild(notice);
                }
            }
        })
        .catch(err => console.error('Report failed:', err));
}