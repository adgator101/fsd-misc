// Basic mobile menu functionality
document.addEventListener("DOMContentLoaded", function () {
  const hamburger = document.querySelector(".hamburger");
  const navMenu = document.querySelector(".nav-menu");

  if (hamburger && navMenu) {
    hamburger.addEventListener("click", function () {
      hamburger.classList.toggle("active");
      navMenu.classList.toggle("active");
    });
  }

  // Close mobile menu when clicking on a link
  document.querySelectorAll(".nav-link").forEach((n) =>
    n.addEventListener("click", () => {
      hamburger.classList.remove("active");
      navMenu.classList.remove("active");
    })
  );

  // Smooth scrolling for navigation links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    });
  });

  // Add fade-in animation to sections on scroll
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("fade-in");
      }
    });
  }, observerOptions);

  // Observe all sections
  document.querySelectorAll("section").forEach((section) => {
    observer.observe(section);
  });

  // Search functionality placeholder
  const searchButton = document.querySelector(".search-button");
  const searchInput = document.querySelector(".search-input");

  if (searchButton && searchInput) {
    searchButton.addEventListener("click", function () {
      const searchTerm = searchInput.value.trim();
      if (searchTerm) {
        // Search logic will go here
        console.log("Search for:", searchTerm);
      }
    });
  }
});

const API_URL = "http://localhost:3000/movies";

const fetchAllMovies = async () => {
  try {
    const response = await fetch(API_URL);
    const data = await response.json();
    console.log("Fetched movies:", data);
    return data;
  } catch (error) {
    console.error("Error fetching movies:", error);
  }
};

let allMovies = [];
// renderMovies(allMovies);
const populateMovieList = async () => {
  allMovies = await fetchAllMovies();
  renderMovies(allMovies);
};

const renderMovies = (movies) => {
  const movieList = document.getElementById("movies-grid");
  movieList.innerHTML = ""; // Clear previous cards
  movies.forEach((movie) => {
    const movieCard = document.createElement("div");
    movieCard.classList.add("movie-card");
    movieCard.innerHTML = `
      <img class="movie-poster" src="https://via.placeholder.com/400x220?text=Poster" alt="Movie Poster" />
      <div class="movie-card-content">
        <h2 class="movie-title">${movie.title}</h2>
        <div class="movie-meta">
          <span class="movie-year"><strong>Year:</strong> ${movie.year}</span>
          <span class="movie-genre"><strong>Genre:</strong> ${movie.genre}</span>
          <span class="movie-director"><strong>Director:</strong> ${movie.director}</span>
          <span class="movie-rating"><strong>Rating:</strong> ${movie.rating}</span>
        </div>
        <p class="movie-description">${movie.description}</p>
        <div class="movie-actions">
          <button class="edit-btn" data-id="${movie.id}">Edit</button>
          <button class="delete-btn" data-id="${movie.id}">Delete</button>
        </div>
      </div>
    `;
    // Add event listeners for edit and delete
    movieCard.querySelector('.edit-btn').addEventListener('click', () => {
      openEditModal(movie);
    });
    movieCard.querySelector('.delete-btn').addEventListener('click', async () => {
      if (confirm(`Delete "${movie.title}"?`)) {
        await deleteMovie(movie.id);
        populateMovieList();
      }
    });
    movieList.appendChild(movieCard);
  });
};

// Delete movie function
async function deleteMovie(id) {
  try {
    const response = await fetch(`${API_URL}/${id}`, { method: 'DELETE' });
    if (!response.ok) throw new Error('Delete failed');
  } catch (err) {
    alert('Error deleting movie');
  }
}

// Edit modal logic
const editModal = document.getElementById('edit-modal');
const closeModalBtn = document.querySelector('.close-modal');
const editForm = document.getElementById('edit-movie-form');

function openEditModal(movie) {
  editModal.classList.add('show');
  document.getElementById('edit-id').value = movie.id;
  document.getElementById('edit-title').value = movie.title;
  document.getElementById('edit-director').value = movie.director;
  document.getElementById('edit-year').value = movie.year;
  document.getElementById('edit-genre').value = movie.genre;
  document.getElementById('edit-rating').value = movie.rating;
  document.getElementById('edit-description').value = movie.description;
}

closeModalBtn.onclick = function() {
  editModal.classList.remove('show');
}

window.onclick = function(event) {
  if (event.target === editModal) {
    editModal.classList.remove('show');
  }
}

editForm.onsubmit = async function(e) {
  e.preventDefault();
  const id = document.getElementById('edit-id').value;
  const updatedMovie = {
    title: document.getElementById('edit-title').value,
    director: document.getElementById('edit-director').value,
    year: parseInt(document.getElementById('edit-year').value),
    genre: document.getElementById('edit-genre').value,
    rating: parseFloat(document.getElementById('edit-rating').value),
    description: document.getElementById('edit-description').value,
  };
  try {
    const response = await fetch(`${API_URL}/${id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(updatedMovie)
    });
    if (!response.ok) throw new Error('Update failed');
    editModal.classList.remove('show');
    populateMovieList();
  } catch (err) {
    alert('Error updating movie');
  }
}

document.addEventListener("DOMContentLoaded", populateMovieList);

const searchElement = document.querySelector(".search-input");

searchElement.addEventListener("input", async (event) => {
  const searchTerm = event.target.value.toLowerCase();
  const filteredMovies = allMovies.filter((movie) => {
    const titleMatch = movie.title.toLowerCase().includes(searchTerm);
    const directorMatch = movie.director.toLowerCase().includes(searchTerm);
    const genreMatch = movie.genre.toLowerCase().includes(searchTerm);

    return titleMatch || directorMatch || genreMatch;
  });

  renderMovies(filteredMovies);
});

document.addEventListener("DOMContentLoaded", function () {
  const addMovieForm = document.querySelector(".movie-form");
  if (addMovieForm) {
    addMovieForm.addEventListener("submit", async (event) => {
      event.preventDefault();
      const submitFormButton = document.querySelector(".add-movie-btn");
      submitFormButton.disabled = true;

      const newMovieData = {
        title: document.querySelector("#title").value,
        director: document.querySelector("#director").value,
        year: parseInt(document.querySelector("#year").value),
        genre: document.querySelector("#genre").value,
        rating: parseFloat(document.querySelector("#rating").value),
        description: document.querySelector("#description").value,
      };
      try {
        const response = await fetch(API_URL, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(newMovieData),
        });
        if (!response.ok) {
          throw new Error("Failed to add movie");
        }
      } catch (error) {
        console.error("Error adding movie:", error);
      } finally {
        submitFormButton.disabled = false;
        addMovieForm.reset();
        populateMovieList();
      }
    });
  }
});
