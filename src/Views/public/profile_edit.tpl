{% extends 'layout' %}

{% block content %}
<div class="pv-profile">
    <div>
        <div class="pv-profile-card">
            <h3 class="pv-profile-section-title">Edit Profile</h3>
            <form method="post" action="/profile/{{ user.username }}/update" class="pv-profile-form">
                {% csrf_field %}

                <div class="pv-profile-form-field">
                    <label class="pv-profile-form-label" for="display_name">Display Name</label>
                    <input type="text" class="pv-profile-form-input" id="display_name" name="display_name"
                           value="{{ profile.display_name }}">
                </div>

                <div class="pv-profile-form-field">
                    <label class="pv-profile-form-label" for="bio">Bio</label>
                    <textarea class="pv-profile-form-textarea" id="bio" name="bio" rows="4">{{ profile.bio }}</textarea>
                </div>

                <div class="pv-profile-form-field">
                    <label class="pv-profile-form-label">Avatar</label>
                    {% media_picker 'avatar' profile.avatar %}
                </div>

                <div class="pv-profile-form-field">
                    <label class="pv-profile-form-label" for="website">Website</label>
                    <input type="text" class="pv-profile-form-input" id="website" name="website"
                           value="{{ profile.website }}">
                </div>

                <div class="pv-profile-form-field">
                    <label class="pv-profile-form-label" for="twitter">Twitter</label>
                    <input type="text" class="pv-profile-form-input" id="twitter" name="twitter"
                           value="{{ profile.twitter }}">
                </div>

                <div class="pv-profile-form-field">
                    <label class="pv-profile-form-label" for="facebook">Facebook</label>
                    <input type="text" class="pv-profile-form-input" id="facebook" name="facebook"
                           value="{{ profile.facebook }}">
                </div>

                <div class="pv-profile-form-field">
                    <label class="pv-profile-form-label" for="linkedin">LinkedIn</label>
                    <input type="text" class="pv-profile-form-input" id="linkedin" name="linkedin"
                           value="{{ profile.linkedin }}">
                </div>

                <div class="pv-profile-form-actions">
                    <button type="submit" class="pv-profile-btn">Save Profile</button>
                    <a href="/profile/{{ user.username }}" class="pv-profile-btn pv-profile-btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <div>
        {! theme_regions.sidebar !}
    </div>
</div>
{% endblock %}
