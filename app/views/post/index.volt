<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('/img/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Clean Blog</h1>
                    <hr class="small">
                    <span class="subheading">A Clean Blog Theme by Start Bootstrap</span>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- Main Content -->
<div class="container">
    <div class="row">
        {% if (user) %}
        Hello {{ user.getName() }} {{ user.getId() }}
        {% endif %}
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            {% for post in posts %}
            <hr>
            <div class="post-preview">
                <a href="{{ url.get("/comment/" ~ post.getId() ~ "/comment") }}">
                    <h2 class="post-title">{{ post.getTitle() }}</h2>
                    <h3 class="post-subtitle">{{ post.getContent() }}</h3>
                </a>
                <p class="post-meta">Date   {{ post.getCreatedAt() }}</p>
            </div>
            {% endfor %}
            <hr>
            <!-- Pager -->
            <ul class="pager">
                <li class="next">
                    <a href="#">Older Posts &rarr;</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<hr>