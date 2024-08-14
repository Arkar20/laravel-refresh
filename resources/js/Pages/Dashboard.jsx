import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { useEffect,useState } from 'react';

export default function Dashboard({ auth,podcasts }) {

    const [localPodcasts, setLocalPodcasts] = useState(podcasts);

    useEffect(()=>{
        Echo.private('App.Models.User.1')
        .listen('ChangeStatusPodcast',({podcast})=>{

            console.log(podcast)
               const newPodcasts = localPodcasts.map(local=>{
                if(local.id===podcast.id){
                    local.status=podcast.status;
                }

                return local;
               })

               setLocalPodcasts(newPodcasts);
        })
    },[])

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />
            {
                localPodcasts.map(podcast=> <div key={podcast.id} className="py-12">
                    <div  className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div className="p-6 text-gray-900">{podcast.name}</div>
                            <span>{podcast.status?'yes':"no"}</span>
                        </div>
                    </div>
                </div>)
            }

        </AuthenticatedLayout>
    );
}
