<div class="tab-pane" id="profile">
    <h5>Account Profile</h5>
    <hr>
    <dl class="dl-horizontal">
        <dt>Username : </dt>
        <dd>{{ ucfirst(Sentry::getUser()->username) }}</dd>
    </dl>

    <dl class="dl-horizontal">
        <dt>Email Address : </dt>
        <dd>{{ Sentry::getUser()->email }}</dd>
    </dl>  

    <dl class="dl-horizontal">
        <dt>Gamer Credit : </dt>
        <dd>${{ Sentry::getUser()->credit }}</dd>
    </dl> 
    <dl class="dl-horizontal">
        <dt>Last Sign In : </dt>
        <dd>Today</dd>
    </dl>
    <dl class="dl-horizontal">
        <dt>Account Status : </dt>
        <dd>Active</dd>
    </dl>
</dl>
</div>