<?php

class SV_RichUsernameSupport_XenForo_Model_Thread extends XFCP_SV_RichUsernameSupport_XenForo_Model_Thread
{
    public function prepareThreadFetchOptions(array $fetchOptions)
    {
        if (!empty($fetchOptions['join']) && ($fetchOptions['join'] & self::FETCH_USER || $fetchOptions['join'] & self::FETCH_AVATAR))
        {
            $fetchOptions['join'] |= self::FETCH_LAST_POST_AVATAR;
        }
        $joinOptions = parent::prepareThreadFetchOptions($fetchOptions);
        if (!empty($fetchOptions['join']) && $fetchOptions['join'] & self::FETCH_LAST_POST_AVATAR)
        {
            $joinOptions['selectFields'] .= '
                , last_post_user.display_style_group_id as last_display_style_group_id
            ';
        }
        return $joinOptions;
    }

    public function prepareThread(array $thread, array $forum, array $nodePermissions = null, array $viewingUser = null)
    {
        $thread = parent::prepareThread($thread, $forum, $nodePermissions, $viewingUser);

        if (isset($thread['last_display_style_group_id']))
        {
            $thread['lastPostInfo']['display_style_group_id'] = $thread['last_display_style_group_id'];
        }

        return $thread;
    }
}
