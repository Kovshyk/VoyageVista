<style>
    .content{
        position: relative;
    }
    .content-optimistic {
        display: none;
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        z-index: 5;
        background-color: rgba(0, 0, 0, 0.65); }
    .content-optimistic__loader {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        margin: auto;
        display: block;
        height: 32px;
        width: 32px;
        -webkit-animation: loader-5-1 2s cubic-bezier(0.77, 0, 0.175, 1) infinite;
        animation: loader-5-1 2s cubic-bezier(0.77, 0, 0.175, 1) infinite; }
    .content-optimistic__loader:before, .content-optimistic__loader:after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto;
        width: 8px;
        height: 8px;
        background: #FFF;
        border-radius: 50%; }
    .content-optimistic__loader:before {
        left: 0;
        right: auto;
        -webkit-animation: loader-5-2 2s cubic-bezier(0.77, 0, 0.175, 1) infinite;
        animation: loader-5-2 2s cubic-bezier(0.77, 0, 0.175, 1) infinite; }
    .content-optimistic__loader:after {
        left: auto;
        right: 0;
        -webkit-animation: loader-5-3 2s cubic-bezier(0.77, 0, 0.175, 1) infinite;
        animation: loader-5-3 2s cubic-bezier(0.77, 0, 0.175, 1) infinite; }
    .content-optimistic__loader span {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        margin: auto;
        height: 32px;
        width: 32px; }
    .content-optimistic__loader span:before, .content-optimistic__loader span:after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto;
        width: 8px;
        height: 8px;
        background: #FFF;
        border-radius: 50%; }
    .content-optimistic__loader span:before {
        left: 0;
        bottom: auto;
        right: 0;
        -webkit-animation: loader-5-4 2s cubic-bezier(0.77, 0, 0.175, 1) infinite;
        animation: loader-5-4 2s cubic-bezier(0.77, 0, 0.175, 1) infinite; }
    .content-optimistic__loader span:after {
        top: auto;
        left: 0;
        bottom: 0;
        right: 0;
        -webkit-animation: loader-5-5 2s cubic-bezier(0.77, 0, 0.175, 1) infinite;
        animation: loader-5-5 2s cubic-bezier(0.77, 0, 0.175, 1) infinite; }


    @-webkit-keyframes loader-5-1 {
        0% {
            -webkit-transform: rotate(0deg); }
        100% {
            -webkit-transform: rotate(360deg); } }

    @keyframes loader-5-1 {
        0% {
            transform: rotate(0deg); }
        100% {
            transform: rotate(360deg); } }

    @-webkit-keyframes loader-5-2 {
        0% {
            -webkit-transform: translate3d(0, 0, 0) scale(1); }
        50% {
            -webkit-transform: translate3d(24px, 0, 0) scale(0.5); }
        100% {
            -webkit-transform: translate3d(0, 0, 0) scale(1); } }

    @keyframes loader-5-2 {
        0% {
            transform: translate3d(0, 0, 0) scale(1); }
        50% {
            transform: translate3d(24px, 0, 0) scale(0.5); }
        100% {
            transform: translate3d(0, 0, 0) scale(1); } }

    @-webkit-keyframes loader-5-3 {
        0% {
            -webkit-transform: translate3d(0, 0, 0) scale(1); }
        50% {
            -webkit-transform: translate3d(-24px, 0, 0) scale(0.5); }
        100% {
            -webkit-transform: translate3d(0, 0, 0) scale(1); } }

    @keyframes loader-5-3 {
        0% {
            transform: translate3d(0, 0, 0) scale(1); }
        50% {
            transform: translate3d(-24px, 0, 0) scale(0.5); }
        100% {
            transform: translate3d(0, 0, 0) scale(1); } }

    @-webkit-keyframes loader-5-4 {
        0% {
            -webkit-transform: translate3d(0, 0, 0) scale(1); }
        50% {
            -webkit-transform: translate3d(0, 24px, 0) scale(0.5); }
        100% {
            -webkit-transform: translate3d(0, 0, 0) scale(1); } }

    @keyframes loader-5-4 {
        0% {
            transform: translate3d(0, 0, 0) scale(1); }
        50% {
            transform: translate3d(0, 24px, 0) scale(0.5); }
        100% {
            transform: translate3d(0, 0, 0) scale(1); } }

    @-webkit-keyframes loader-5-5 {
        0% {
            -webkit-transform: translate3d(0, 0, 0) scale(1); }
        50% {
            -webkit-transform: translate3d(0, -24px, 0) scale(0.5); }
        100% {
            -webkit-transform: translate3d(0, 0, 0) scale(1); } }

    @keyframes loader-5-5 {
        0% {
            transform: translate3d(0, 0, 0) scale(1); }
        50% {
            transform: translate3d(0, -24px, 0) scale(0.5); }
        100% {
            transform: translate3d(0, 0, 0) scale(1); } }
</style>

<div class="content-optimistic js_content_loader">
    <div class="content-optimistic__loader"><span></span></div><div class="text-center">Ajax request. Please wait...</div>
</div>