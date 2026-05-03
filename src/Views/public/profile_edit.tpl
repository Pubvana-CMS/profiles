{% extends 'layout' %}

{% block content %}
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Profile</h3>
            </div>
            <div class="card-body">
                <form method="post" action="/profile/{{ user.username }}/update">
                    {% csrf_field %}

                    <div class="mb-3">
                        <label class="form-label" for="display_name">Display Name</label>
                        <input type="text" class="form-control" id="display_name" name="display_name"
                               value="{{ profile.display_name }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="bio">Bio</label>
                        <textarea class="form-control" id="bio" name="bio" rows="4">{{ profile.bio }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Avatar</label>
                        {% media_picker 'avatar' profile.avatar %}
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="website">Website</label>
                        <input type="text" class="form-control" id="website" name="website"
                               value="{{ profile.website }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="twitter">Twitter</label>
                        <input type="text" class="form-control" id="twitter" name="twitter"
                               value="{{ profile.twitter }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="facebook">Facebook</label>
                        <input type="text" class="form-control" id="facebook" name="facebook"
                               value="{{ profile.facebook }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="linkedin">LinkedIn</label>
                        <input type="text" class="form-control" id="linkedin" name="linkedin"
                               value="{{ profile.linkedin }}">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Save Profile</button>
                        <a href="/profile/{{ user.username }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        {! theme_regions.sidebar !}
    </div>
</div>
{% endblock %}
