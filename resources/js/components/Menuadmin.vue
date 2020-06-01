<template>
    <div>
        <div class="menu">
            <ul>
                <li>
                    <router-link :to="{ name: 'dashboard'}"><i class="fa fa-home"></i> <span class="text">DASHBOARD</span></router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'createpost'}"><i class="fa fa-pencil-square-o"></i> <span class="text">NEW POST</span></router-link>
                </li>
            </ul>
        </div>
    </div>
</template>