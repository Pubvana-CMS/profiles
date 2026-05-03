{% extends 'layout' %}

{% block content %}
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    {% if avatar_url %}
                    <img src="{{ avatar_url }}" class="rounded-circle me-3" alt="{{ user.username }}" width="80" height="80">
                    {% endif %}
                    <div>
                        <h1 class="mb-0">{{ profile.display_name | default(user.username) }}</h1>
                        <p class="text-muted mb-0">@{{ user.username }}</p>
                    </div>
                </div>

                {% if profile.bio %}
                <div class="mb-4">
                    <h5>Bio</h5>
                    <p>{{ profile.bio }}</p>
                </div>
                {% endif %}

                {% if profile.website or profile.twitter or profile.facebook or profile.linkedin %}
                <div class="mb-4">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        {% if profile.website %}
                        <li><a href="{{ profile.website }}" rel="nofollow noopener">{{ profile.website }}</a></li>
                        {% endif %}
                        {% if profile.twitter %}
                        <li><a href="https://twitter.com/{{ profile.twitter }}" rel="nofollow noopener">@{{ profile.twitter }}</a></li>
                        {% endif %}
                        {% if profile.facebook %}
                        <li><a href="https://facebook.com/{{ profile.facebook }}" rel="nofollow noopener">{{ profile.facebook }}</a></li>
                        {% endif %}
                        {% if profile.linkedin %}
                        <li><a href="https://linkedin.com/in/{{ profile.linkedin }}" rel="nofollow noopener">{{ profile.linkedin }}</a></li>
                        {% endif %}
                    </ul>
                </div>
                {% endif %}

                {% if isOwner %}
                <a href="/profile/{{ user.username }}/edit" class="btn btn-primary">Edit Profile</a>
                {% endif %}
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        {! theme_regions.sidebar !}
    </div>
</div>
{% endblock %}
