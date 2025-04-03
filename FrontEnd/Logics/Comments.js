document.addEventListener('DOMContentLoaded', () => {
  const commentForm = document.querySelector('form');
  const commentsContainer = document.querySelector('.space-y-6');

  commentForm.addEventListener('submit', function(e) {
      e.preventDefault();

      // Get form values
      const fullName = document.getElementById('fullName').value;
      const email = document.getElementById('email').value;
      const message = document.getElementById('message').value;

      // Validate inputs
      if (!fullName || !email || !message) {
          alert('Please fill in all fields');
          return;
      }

      // Create new comment element
      const newCommentDiv = document.createElement('div');
      newCommentDiv.className = 'flex items-start space-x-4 pb-6 border-b border-gray-200';
      
      // Get current date
      const currentDate = new Date();
      const formattedDate = currentDate.toLocaleDateString('en-US', {
          day: 'numeric',
          month: 'short',
          year: 'numeric'
      });

      newCommentDiv.innerHTML = `
          <img src="/api/placeholder/40/40" alt="${fullName}" class="w-10 h-10 rounded-full">
          <div>
              <div class="flex items-center space-x-2">
                  <h4 class="font-semibold text-gray-800">${fullName}</h4>
                  <span class="text-sm text-gray-500">${formattedDate}</span>
              </div>
              <p class="text-gray-600 mt-2">${message}</p>
          </div>
      `;

      // Prepend the new comment to the comments container
      commentsContainer.insertBefore(newCommentDiv, commentsContainer.firstChild);

      // Clear form fields
      commentForm.reset();
  });
});